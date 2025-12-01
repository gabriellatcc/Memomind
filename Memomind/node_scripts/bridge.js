require('dotenv').config();
const { SerialPort } = require('serialport');
const { ReadlineParser } = require('@serialport/parser-readline');
const axios = require('axios');

const portPath = process.env.ARDUINO_PORT || 'COM3';
const userId = process.env.GAME_USER_ID || null; 
const apiUrl = process.env.API_URL || 'http://localhost:8000/api/arduino/salvar';

console.log(`[NODE] --- INICIANDO SERVIÇO DE ESCUTA ARDUINO ---`);
console.log(`[NODE] Porta: ${portPath}`);
console.log(`[NODE] Usuario ID vinculado: ${userId ? userId : 'Nenhum (Visitante)'}`);

const port = new SerialPort({
    path: portPath,
    baudRate: 9600,
    autoOpen: false
});

port.open((err) => {
    if (err) {
        console.error('[ERRO] Falha ao abrir porta Serial:', err.message);
        process.exit(1); 
    }
    console.log('[NODE] Conexão Serial estabelecida com sucesso! Aguardando dados...');
});

const parser = port.pipe(new ReadlineParser({ delimiter: '\r\n' }));

parser.on('data', async (data) => {
    console.log(`[ARDUINO DISSE]: ${data}`);

    try {
        const jsonDados = JSON.parse(data);

        const payload = {
            ...jsonDados,
            user_id: userId 
        };

        console.log('[NODE] Enviando para Laravel:', payload);
        
        const response = await axios.post(apiUrl, payload);
        console.log(`[LARAVEL RESPONDEU]: ${response.status} - Salvo com sucesso.`);

    } catch (e) {
        console.error('[ERRO] Falha ao processar:', e.message);
        if(e.response) {
             console.error('[ERRO DETALHE]:', e.response.data);
        }
    }
});