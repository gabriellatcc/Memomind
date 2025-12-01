#!/bin/bash

BOARD_FQBN="arduino:avr:uno"
ARDUINO_HOME="/home/gabriellacorrea/Arduino" 
SERIAL_PORT="/dev/ttyACM0"

DETECTED_PORT=$(ls /dev/ttyACM* 2>/dev/null | head -n 1)

if [ -n "$DETECTED_PORT" ]; then
    SERIAL_PORT="$DETECTED_PORT"
else
    :
fi

SKETCH_DIR="$(pwd)/../assets/arduino/jogomemoria"
PARAR_DIR="$(pwd)/../assets/arduino/parar"

if [ ! -d "${SKETCH_DIR}" ]; then
    echo "Erro: O diretório do sketch não foi encontrado em: ${SKETCH_DIR}" >&2
    exit 1
fi

if [ -f "${SKETCH_DIR}/parar.ino" ]; then
    mkdir -p "${PARAR_DIR}"
    mv "${SKETCH_DIR}/parar.ino" "${PARAR_DIR}/"
fi

arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}" > /dev/null
COMPILE_STATUS=$?

if [ $COMPILE_STATUS -ne 0 ]; then
    echo "❌ Erro de compilação. Verifique o código-fonte." >&2 
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
        if [ $RETRY_COUNT -lt $MAX_RETRIES ]; then
            sleep 2
        fi
    fi
done

if [ $UPLOAD_SUCCESS -eq 1 ]; then
    echo "Upload concluído! Jogo iniciado com sucesso."
    exit 0
else
    echo "❌ Falha no upload após $MAX_RETRIES tentativas." >&2 
    echo "Verifique: Cabo USB instável, porta errada ou Arduino travado." >&2
    exit 1
fi