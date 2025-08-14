<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$usuarios = [
    ['João Silva', 25, 'joao@email.com'],
    ['Maria Santos', 30, 'maria@email.com'],
    ['Pedro Costa', 28, 'pedro@email.com'],
    ['Ana Oliveira', 22, 'ana@email.com']
];

$stmt = $conexao->prepare("INSERT INTO usuarios (nome, idade, email) VALUES (?, ?, ?)");

foreach ($usuarios as $usuario) {
    $stmt->bind_param("sis", $usuario[0], $usuario[1], $usuario[2]);
    $stmt->execute();
}

echo "Inseridos " . count($usuarios) . " usuários com sucesso!";

$stmt->close();
$conexao->close();
?>
