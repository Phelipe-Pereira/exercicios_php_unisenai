<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    
    echo "<h2>Dados Recebidos:</h2>";
    echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<a href='formulario_simples.php'>Voltar ao formulário</a>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulário Simples</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
    <form method="POST" action="">
        <p>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required>
        </p>
        <p>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <input type="submit" value="Enviar">
        </p>
    </form>
</body>
</html>
<?php
}
?>
