#!/bin/bash

CURRENT_USER_ID="${GAME_USER_ID:-}"

echo "--- [DEPLOY] Iniciando ---"
echo "Usuario ID recebido do Laravel: $CURRENT_USER_ID"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"
NODE_SCRIPT_DIR="$ROOT_DIR/node_scripts"
ARDUINO_ASSETS_DIR="$ROOT_DIR/assets/arduino"

BOARD_FQBN="arduino:avr:uno"
ARDUINO_HOME="/home/gabriellacorrea/Arduino" #meu local de instalação do Arduino IDE
DEFAULT_SERIAL_PORT="/dev/ttyACM0"

DETECTED_PORT=$(ls /dev/ttyACM* 2>/dev/null | head -n 1)

if [ -n "$DETECTED_PORT" ]; then
    SERIAL_PORT="$DETECTED_PORT"
else
    SERIAL_PORT="$DEFAULT_SERIAL_PORT"
fi

echo "Porta detectada: $SERIAL_PORT"

echo "Encerrando processos antigos..."
pkill -f "bridge.js" || true
pkill -f "node .*bridge.js" || true
sleep 1

SKETCH_DIR="$ARDUINO_ASSETS_DIR/jogomemoria"
PARAR_DIR="$ARDUINO_ASSETS_DIR/parar"

if [ -f "${SKETCH_DIR}/parar.ino" ]; then
    mkdir -p "${PARAR_DIR}"
    mv "${SKETCH_DIR}/parar.ino" "${PARAR_DIR}/"
fi

echo "Compilando..."
arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}" > /dev/null

MAX_RETRIES=5
RETRY_COUNT=0
UPLOAD_SUCCESS=0

echo "Fazendo Upload..."
while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    RETRY_COUNT=$((RETRY_COUNT+1))
    
    arduino-cli upload -p "${SERIAL_PORT}" --fqbn "${BOARD_FQBN}" "${SKETCH_DIR}" > /dev/null
    if [ $? -eq 0 ]; then
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
    
    echo "🔌 Iniciando ponte Node.js..."
    cd "$NODE_SCRIPT_DIR" || exit
    
    nohup env ARDUINO_PORT="$SERIAL_PORT" GAME_USER_ID="$CURRENT_USER_ID" node bridge.js > arduino_log.txt 2>&1 &
    
    echo "Monitoramento ativo para User ID: $CURRENT_USER_ID"
    exit 0
else
    echo "Falha no upload." >&2
    exit 1
fi