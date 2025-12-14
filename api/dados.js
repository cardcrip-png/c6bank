import fs from 'fs'
import path from 'path'

const filePath = path.join(process.cwd(), 'dados.json')

export default function handler(req, res) {
  try {
    if (!fs.existsSync(filePath)) {
      return res.status(200).json([])
    }

    const conteudo = fs.readFileSync(filePath, 'utf8')
    const dados = JSON.parse(conteudo)
    return res.status(200).json(Array.isArray(dados) ? dados : [])
  } catch (error) {
    console.error('Erro ao ler dados:', error)
    return res.status(500).json({ error: 'Erro ao ler dados' })
  }
}

