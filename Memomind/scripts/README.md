## Documentação de configuração do ShellScript

    1. Navegue até a raiz do seu projeto Laravel
    2. Abra um terminal integrado a raiz
    3. Defina a variável HOME temporariamente para o diretório de configuração do Arduino CLI (garante que a plataforma será instalada onde o PHP (web server) procurará)
    export HOME=$(pwd)/storage/app/arduino-cli-home
    4. Instale a plataforma AVR (para selecionar o arduino em uso depois)
    arduino-cli core install arduino:avr
    5. Baixe a biblioteca LiquidCrystal (controle do lcd)
    arduino-cli lib install LiquidCrystal
    6. Limpar variavel home (opcional)
    unset HOME