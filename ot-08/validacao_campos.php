<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$erros = [];
$nome = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (empty($nome)) {
        $erros[] = "O campo Nome é obrigatório.";
    } elseif (strlen($nome) < 2) {
        $erros[] = "O nome deve ter pelo menos 2 caracteres.";
    }
    
    if (empty($email)) {
        $erros[] = "O campo Email é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email informado não é válido.";
    }
    
    if (empty($erros)) {
        echo "<h2>Dados Válidos!</h2>";
        echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<a href='validacao_campos.php'>Novo cadastro</a>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Validação de Campos</title>
    <style>
        .erro { color: red; margin: 10px 0; }
        .campo { margin: 10px 0; }
        input { padding: 5px; width: 250px; }
    </style>
</head>
<body>
    <h2>Formulário com Validação</h2>
    
    <?php if (!empty($erros)): ?>
        <div class="erro">
            <h3>Erros encontrados:</h3>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo htmlspecialchars($erro); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="campo">
            <label for="nome">Nome: *</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        </div>
        <div class="campo">
            <label for="email">Email: *</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="campo">
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>
