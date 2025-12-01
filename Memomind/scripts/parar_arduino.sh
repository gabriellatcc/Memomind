#!/bin/bash

BOARD_FQBN="arduino:avr:uno"
ARDUINO_HOME="/home/gabriellacorrea/Arduino" 
SERIAL_PORT="/dev/ttyACM0"

DETECTED_PORT=$(ls /dev/ttyACM* 2>/dev/null | head -n 1)

if [ -n "$DETECTED_PORT" ]; then
    SERIAL_PORT="$DETECTED_PORT"
else
    echo "⚠️ Nenhuma porta detectada automaticamente. Usando padrão: ${SERIAL_PORT}"
fi

WRONG_DIR="$(pwd)/../assets/arduino/jogomemoria"
SKETCH_DIR="$(pwd)/../assets/arduino/parar"


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
  lcd.display(); 

  lcd.setCursor(0, 0); 
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

sleep 0.5

arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}"
COMPILE_STATUS=$?

if [ $COMPILE_STATUS -ne 0 ]; then
    echo "❌ Erro de compilação no código de parar." >&2 
    exit $COMPILE_STATUS
fi

MAX_RETRIES=3
RETRY_COUNT=0
UPLOAD_SUCCESS=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    RETRY_COUNT=$((RETRY_COUNT+1))
    
    arduino-cli upload -p "${SERIAL_PORT}" --fqbn "${BOARD_FQBN}" "${SKETCH_DIR}"
    UPLOAD_STATUS=$?
    
    if [ $UPLOAD_STATUS -eq 0 ]; then
        UPLOAD_SUCCESS=1
        break
    else
        echo "⚠️  Falha na tentativa $RETRY_COUNT (Arduino ocupado?)."
        if [ $RETRY_COUNT -lt $MAX_RETRIES ]; then
            echo "⏳ Aguardando 2 segundos para tentar forçar novamente..."
            sleep 2
        fi
    fi
done

if [ $UPLOAD_SUCCESS -eq 1 ]; then
    exit 0
else
    echo "❌ Não foi possível parar o Arduino após $MAX_RETRIES tentativas." >&2
    echo "Dica: Desconecte e reconecte o cabo USB se ele estiver travado." >&2
    exit 1
fi