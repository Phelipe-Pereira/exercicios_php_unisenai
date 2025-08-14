<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$idUsuario = 1;
$novaIdade = 30;

$stmt = $conexao->prepare("UPDATE usuarios SET idade = ? WHERE id = ?");
$stmt->bind_param("ii", $novaIdade, $idUsuario);

if ($stmt->execute()) {
    echo "Idade do usuário ID $idUsuario atualizada para $novaIdade anos.";
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
