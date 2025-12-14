# C6 Bank - Aumento de Limite (React + Vercel)

Aplicação React convertida do PHP original, mantendo exatamente o mesmo design e funcionalidades. Configurada para deploy na Vercel usando Serverless Functions.

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

## Como rodar localmente

### Desenvolvimento
```bash
npm run dev
```
A aplicação estará disponível em `http://localhost:3000`

**Nota:** As APIs serverless funcionam apenas quando deployado na Vercel. Para desenvolvimento local, você pode usar o Vercel CLI:
```bash
npm i -g vercel
vercel dev
```

## Deploy na Vercel

1. Instale a Vercel CLI (se ainda não tiver):
```bash
npm i -g vercel
```

2. Faça o deploy:
```bash
vercel
```

Ou conecte seu repositório GitHub na [Vercel Dashboard](https://vercel.com)

## Estrutura do Projeto

```
c6-react/
├── api/                    # Serverless Functions (Vercel)
│   ├── salvar-dados.js    # API para salvar dados
│   └── dados.js           # API para obter dados
├── public/                # Arquivos estáticos (imagens, fontes)
│   ├── background.jpg
│   └── c6.ttf
├── src/
│   ├── App.jsx            # Componente principal
│   ├── App.css            # Estilos do App
│   ├── Painel.jsx         # Componente do painel administrativo
│   ├── Painel.css         # Estilos do painel
│   ├── main.jsx           # Ponto de entrada
│   └── index.css          # Estilos globais
├── dados.json             # Arquivo JSON com dados salvos
├── vercel.json            # Configuração da Vercel
├── index.html
├── package.json
└── vite.config.js
```

## Rotas

- `/` - Página principal (formulário)
- `/painel` - Painel administrativo

## API Endpoints (Serverless Functions)

- `POST /api/salvar-dados` - Salva os dados coletados
- `GET /api/dados` - Retorna todos os dados salvos

## Tecnologias

- React 18
- React Router DOM
- Vite
- Vercel Serverless Functions
- Node.js

## Diferenças do projeto original

- ✅ Usa Serverless Functions ao invés de Express
- ✅ Configurado para deploy na Vercel
- ✅ APIs em `/api/` ao invés de servidor separado
- ✅ Sem necessidade de `server.js` ou `npm run server`
