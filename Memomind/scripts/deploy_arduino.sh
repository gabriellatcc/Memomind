#!/bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"
NODE_SCRIPT_DIR="$ROOT_DIR/node_scripts"
ARDUINO_ASSETS_DIR="$ROOT_DIR/assets/arduino"

BOARD_FQBN="arduino:avr:uno"
ARDUINO_HOME="/home/gabriellacorrea/Arduino" 
DEFAULT_SERIAL_PORT="/dev/ttyACM0"

DETECTED_PORT=$(ls /dev/ttyACM* 2>/dev/null | head -n 1)

if [ -n "$DETECTED_PORT" ]; then
    SERIAL_PORT="$DETECTED_PORT"
else
    SERIAL_PORT="$DEFAULT_SERIAL_PORT"
fi

echo "--- [DEPLOY] Iniciando ---"
echo "Porta: $SERIAL_PORT"

echo "Encerrando processos antigos..."
pkill -f "bridge.js" || true
pkill -f "node .*bridge.js" || true
sleep 1

SKETCH_DIR="$ARDUINO_ASSETS_DIR/jogomemoria"
PARAR_DIR="$ARDUINO_ASSETS_DIR/parar"

if [ ! -d "${SKETCH_DIR}" ]; then
    echo "Erro: Diretório do sketch não encontrado: ${SKETCH_DIR}" >&2
    exit 1
fi

if [ -f "${SKETCH_DIR}/parar.ino" ]; then
    mkdir -p "${PARAR_DIR}"
    mv "${SKETCH_DIR}/parar.ino" "${PARAR_DIR}/"
fi

arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}" > /dev/null
COMPILE_STATUS=$?

if [ $COMPILE_STATUS -ne 0 ]; then
    echo "Erro de compilação." >&2 
    exit $COMPILE_STATUS
fi

MAX_RETRIES=5
RETRY_COUNT=0
UPLOAD_SUCCESS=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    RETRY_COUNT=$((RETRY_COUNT+1))
    
    arduino-cli upload -p "${SERIAL_PORT}" --fqbn "${BOARD_FQBN}" "${SKETCH_DIR}" > /dev/null
    UPLOAD_STATUS=$?
    
    if [ $UPLOAD_STATUS -eq 0 ]; then
        UPLOAD_SUCCESS=1
        break
    else
        pkill -f "bridge.js" || true
        sleep 2
    fi
done

if [ $UPLOAD_SUCCESS -eq 1 ]; then
    echo "Upload concluído!"
    sleep 2
    
    echo "Iniciando ponte Node.js na porta $SERIAL_PORT..."
    cd "$NODE_SCRIPT_DIR" || exit
    
    nohup env ARDUINO_PORT="$SERIAL_PORT" GAME_USER_ID="$GAME_USER_ID" node bridge.js > arduino_log.txt 2>&1 &
    
    echo "Jogo rodando e monitorado para o Usuário ID: $GAME_USER_ID"
    exit 0
else
    echo "Falha no upload." >&2 
    exit 1
fi