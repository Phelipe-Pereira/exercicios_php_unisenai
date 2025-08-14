<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$email = "usuario@exemplo.com";

$stmt = $conexao->prepare("SELECT id, nome FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $token = bin2hex(random_bytes(32));
    $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    $stmtToken = $conexao->prepare("UPDATE usuarios SET token_recuperacao = ?, token_expiracao = ? WHERE id = ?");
    $stmtToken->bind_param("ssi", $token, $expiracao, $usuario['id']);
    
    if ($stmtToken->execute()) {
        echo "Token de recuperação gerado para " . $usuario['nome'] . " (ID: " . $usuario['id'] . ")";
        echo "Token: " . $token;
    }
    $stmtToken->close();
} else {
    echo "E-mail não encontrado no sistema.";
}

$stmt->close();
$conexao->close();
?>
