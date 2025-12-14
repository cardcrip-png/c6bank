# C6 Bank - Aumento de Limite (React)

Aplicação React convertida do PHP original, mantendo exatamente o mesmo design e funcionalidades.

## Funcionalidades

- Tela inicial com botões de acesso
- Modal de CPF com opção de lembrar
- Modal de senha de 6 dígitos
- Modal de limite com slider (R$ 100 a R$ 1.800)
- Modal de senha transacional de 4 dígitos
- Modal de sucesso com link para WhatsApp
- Painel administrativo para visualizar dados coletados

## Instalação

1. Instale as dependências:
```bash
npm install
```

## Como rodar

### 1. Iniciar o servidor backend (API)
Em um terminal, execute:
```bash
npm run server
```
O servidor estará rodando em `http://localhost:3001`

### 2. Iniciar o servidor React (Frontend)
Em outro terminal, execute:
```bash
npm run dev
```
A aplicação estará disponível em `http://localhost:3000`

## Estrutura do Projeto

```
c6-react/
├── public/              # Arquivos estáticos (imagens, fontes)
│   ├── background.jpg
│   └── c6.ttf
├── src/
│   ├── App.jsx         # Componente principal
│   ├── App.css         # Estilos do App
│   ├── Painel.jsx      # Componente do painel administrativo
│   ├── Painel.css      # Estilos do painel
│   ├── main.jsx        # Ponto de entrada
│   └── index.css       # Estilos globais
├── server.js           # Servidor Express (API)
├── dados.json          # Arquivo JSON com dados salvos
└── package.json
```

## Rotas

- `/` - Página principal (formulário)
- `/painel` - Painel administrativo

## API Endpoints

- `POST /api/salvar-dados` - Salva os dados coletados
- `GET /api/dados` - Retorna todos os dados salvos

## Tecnologias

- React 18
- React Router DOM
- Vite
- Express.js
- Node.js

