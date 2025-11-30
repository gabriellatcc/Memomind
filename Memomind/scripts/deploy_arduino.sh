BOARD_FQBN="arduino:avr:uno"

SERIAL_PORT="/dev/ttyACM0"

# O caminho completo do diretório 'Arduino' (o seu 'sketchbook')
# É aqui que o arduino-cli encontrará a pasta 'libraries'.
ARDUINO_HOME="/home/gabriellacorrea/Arduino" 

SKETCH_DIR="$(pwd)/../assets/arduino/jogomemoria"

if [ ! -d "${SKETCH_DIR}" ]; then
    echo "Erro: O diretório do sketch não foi encontrado em: ${SKETCH_DIR}" >&2
    exit 1
fi

echo "Iniciando processo de deploy..."
echo "Placa: ${BOARD_FQBN}"
echo "Porta: ${SERIAL_PORT}"
echo "Sketch Path: ${SKETCH_DIR}"


echo "Compilando o sketch..."
arduino-cli compile --fqbn "${BOARD_FQBN}" --libraries "${ARDUINO_HOME}/libraries" "${SKETCH_DIR}"
COMPILE_STATUS=$?

if [ $COMPILE_STATUS -eq 0 ]; then
    echo "Compilação bem-sucedida!"

    echo "Fazendo upload para a placa..."
    arduino-cli upload -p "${SERIAL_PORT}" --fqbn "${BOARD_FQBN}" "${SKETCH_DIR}"
    UPLOAD_STATUS=$?
    
    if [ $UPLOAD_STATUS -eq 0 ]; then
        echo "Upload concluído com sucesso!"
        exit 0
    else
        echo "Erro durante o upload. Verifique a conexão e as permissões de porta." >&2 
        exit 1
    fi
else
    echo "Erro de compilação. Verifique o código-fonte." >&2 
    exit $COMPILE_STATUS
fi