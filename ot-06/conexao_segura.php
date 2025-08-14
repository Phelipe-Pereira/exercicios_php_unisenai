<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$config = [
    'host' => 'localhost',
    'usuario' => 'usuario',
    'senha' => 'senha',
    'banco' => 'banco_de_dados'
];

try {
    $conexao = new mysqli($config['host'], $config['usuario'], $config['senha'], $config['banco']);
    
    if ($conexao->connect_error) {
        throw new Exception("Falha na conexão: " . $conexao->connect_error);
    }
    
    $conexao->set_charset("utf8");
    echo "Conexão segura estabelecida com sucesso!";
    
} catch (Exception $e) {
    error_log("Erro de conexão: " . $e->getMessage());
    die("Erro interno do servidor.");
}

$conexao->close();
?>
