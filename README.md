# MEMOMIND
### Sistema Híbrido de Intervenção Terapêutica para TEA

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/Arduino-00979D?style=for-the-badge&logo=Arduino&logoColor=white" />
  <img src="https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white" />
</p>

---

## Sobre o Projeto

O **Memomind** é uma plataforma inovadora que une hardware e software para auxiliar no desenvolvimento cognitivo de pacientes com **TEA (Transtorno do Espectro Autista)**.

Diferente de jogos de memória comuns, o Memomind foi projetado seguindo diretrizes clínicas rigorosas para **redução de carga sensorial** (ausência de sons intrusivos, paleta de cores controlada) e possui um sistema robusto de coleta de dados automatizada.

O projeto integra um dispositivo físico (Arduino) a uma aplicação web (Laravel) através de um middleware personalizado em Node.js, permitindo que terapeutas acompanhem a evolução dos pacientes em tempo real através de relatórios detalhados.

Agosto 2025 - Dezembro 2025.
## Tecnologias Utilizadas

### Full Stack Web
* **Backend:** PHP 8.2+ com Framework Laravel (API RESTful & MVC).
* **Frontend:** Blade Templates, Tailwind CSS e CSS Puro.
* **Design System:** Neon/Dark (Focado em conforto visual).
* **Banco de Dados:** MySQL.

### Hardware & Integração (IoT)
* **Hardware:** Arduino Uno (Linguagem C++).
* **Middleware/Bridge:** Node.js (Biblioteca `serialport`).
* **Automação:** Shell Scripts (`.sh`) para orquestração de processos no ambiente Linux.
* **Upload:** Arduino CLI.

---

## ⚙️ Arquitetura do Sistema

O sistema opera em uma arquitetura de **Gateway Serial**, onde o software web controla o hardware físico:

1.  **Arduino:** Gerencia a lógica física do jogo (sequência de luzes, leitura de botões).
2.  **Shell Automation:** Ao clicar em "Jogar" no painel web, o Laravel dispara scripts Bash que gerenciam a compilação e o upload do código `.ino` para a placa.
3.  **Node.js Bridge:** Um serviço em background escuta a porta USB (`/dev/ttyACM0`), captura os resultados das partidas e injeta o ID do usuário na sessão.
4.  **Laravel API:** Recebe o payload JSON via HTTP POST do Node.js e persiste os dados analíticos no MySQL.

---

## 🚀 Como Rodar o Projeto

### 1. Pré-requisitos
Certifique-se de ter instalado em sua máquina:
* [PHP 8.1+](https://www.php.net/) & [Composer](https://getcomposer.org/)
* [Node.js & NPM](https://nodejs.org/)
* [MySQL](https://www.mysql.com/)
* [Arduino CLI](https://arduino.github.io/arduino-cli/latest/) (**Obrigatório** para os scripts de automação).

### 2. Configuração do Backend (Laravel)

Clone o repositório e acesse a pasta do projeto:

```bash
git clone [https://github.com/gabriellatcc/Memomind.git](https://github.com/gabriellatcc/Memomind.git)
cd Memomind
```

### 3. Instale as dependências do PHP:
```bash
composer install
```

### 4. Configure o ambiente (copie o arquivo de exemplo e configure o banco de dados):
```bash
cp .env.example .env
```
Edite o arquivo .env com suas credenciais do banco (DB_DATABASE, DB_USERNAME, etc)

### 5. Gere a chave da aplicação e rode as migrações:
```bash
php artisan key:generate
php artisan migrate
```

### 6. Configuração do Middleware (Node.js)
O sistema possui uma pasta dedicada para a ponte serial. Instale as dependências dela:
```bash
cd node_scripts
npm install
cd ..
```

### 7. Permissões de Execução (Linux)

Para que o Laravel consiga executar os scripts de automação e invocar o Arduino CLI, conceda permissão de execução:
```bash
chmod +x scripts/*.sh
```
### 8.Configuração do Hardware
* Conecte o Arduino Uno na porta USB do computador.
* Verifique se a porta detectada é /dev/ttyACM0 (este é o padrão configurado nos scripts).
* Certifique-se que o arduino-cli está instalado e acessível globalmente no seu PATH.

# EXECUÇÃO
Inicie o servidor de desenvolvimento do Laravel:
```bash
php artisan serve
    Acesse http://localhost:8000. 
```
* Para Jogar faça login, vá para a Home e clique em "Jogar".
O sistema irá automaticamente compilar o código, enviar para o Arduino e iniciar o listener Node.js.
* Para Parar: Clique em "Parar" na interface para interromper o processo Node.js e liberar a porta USB.
# Equipe de Desenvolvimento
* Gabriella Corrêa - <strong>Full Stack & Integração</strong>
* Érico Quintana - <strong>Design de Front-end e pré-implementação</strong>
* Maria Auxiliadora - <strong>Design de Front-end</strong>
* Matheus Almeida - <strong>Documentação</strong>

Este projeto foi desenvolvido para o Acelera Fatec (FATEC Cruzeiro) sob orientação dos professores Carlos Alberto do Nascimento e Carlos Henrique Loureiro Feichas.