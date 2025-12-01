#!/bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"
ARDUINO_ASSETS_DIR="$ROOT_DIR/assets/arduino"

BOARD_FQBN="arduino:avr:uno"
ARDUINO_HOME="/home/gabriellacorrea/Arduino" 
DEFAULT_SERIAL_PORT="/dev/ttyACM0"

DETECTED_PORT=$(ls /dev/ttyACM* 2>/dev/null | head -n 1)

if [ -n "$DETECTED_PORT" ]; then
    SERIAL_PORT="$DETECTED_PORT"
else
    echo "Nenhuma porta detectada automaticamente. Usando padrão: ${SERIAL_PORT}"
    SERIAL_PORT="$DEFAULT_SERIAL_PORT"
fi

echo "--- [PARAR] Iniciando interrupção ---"

echo "Encerrando conexão do monitoramento..."

pkill -f "bridge.js" || true
pkill -f "node .*bridge.js" || true

sleep 2

WRONG_DIR="$ARDUINO_ASSETS_DIR/jogomemoria"
SKETCH_DIR="$ARDUINO_ASSETS_DIR/parar"

if [ ! -d "${SKETCH_DIR}" ]; then
    mkdir -p "${SKETCH_DIR}"
fi

cat > "${SKETCH_DIR}/parar.ino" <<EOF
#include <LiquidCrystal.h>

LiquidCrystal lcd(12, 11, 10, 13, A4, A5);

void setup() {
  for (int i = 0; i <= 9; i++) {
    pinMode(i, OUTPUT);
    digitalWrite(i, LOW);
  }

  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("      JOGO      ");
  lcd.setCursor(0, 1);
  lcd.print("  INTERROMPIDO  ");
}

void loop() { 
}
EOF

if [ -f "${WRONG_DIR}/parar.ino" ]; then
    rm "${WRONG_DIR}/parar.ino"
fi

echo "Compilando código de parada..."
arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}" > /dev/null
COMPILE_STATUS=$?

if [ $COMPILE_STATUS -ne 0 ]; then
    echo "Erro de compilação no código de parar." >&2 
    exit $COMPILE_STATUS
fi

MAX_RETRIES=5
RETRY_COUNT=0
UPLOAD_SUCCESS=0

echo "Enviando código de parada..."
while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    RETRY_COUNT=$((RETRY_COUNT+1))
    
    arduino-cli upload -p "${SERIAL_PORT}" --fqbn "${BOARD_FQBN}" "${SKETCH_DIR}" > /dev/null
    UPLOAD_STATUS=$?
    
    if [ $UPLOAD_STATUS -eq 0 ]; then
        UPLOAD_SUCCESS=1
        break
    else
        echo "Tentativa $RETRY_COUNT falhou (Porta ocupada?)."
        pkill -f "bridge.js" || true
        sleep 2
    fi
done

if [ $UPLOAD_SUCCESS -eq 1 ]; then
    echo "Jogo interrompido com sucesso."
    exit 0
else
    echo "Falha ao parar o Arduino. Verifique se o cabo está conectado." >&2
    exit 1
fi