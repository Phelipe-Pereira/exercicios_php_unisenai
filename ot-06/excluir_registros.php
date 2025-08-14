<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$idadeLimite = 18;

$stmt = $conexao->prepare("DELETE FROM usuarios WHERE idade < ?");
$stmt->bind_param("i", $idadeLimite);

if ($stmt->execute()) {
    $registrosAfetados = $stmt->affected_rows;
    echo "Excluídos $registrosAfetados registros de usuários com idade menor que $idadeLimite anos.";
} else {
    echo "Erro ao excluir: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
