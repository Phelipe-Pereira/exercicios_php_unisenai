<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

session_start();

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    if (!empty($usuario) && !empty($senha)) {
        if ($usuario === 'admin' && $senha === '123456') {
            $_SESSION['usuario_id'] = 1;
            $_SESSION['usuario_nome'] = $usuario;
            $_SESSION['logado'] = true;
            $_SESSION['ultimo_acesso'] = time();
            
            header('Location: area_protegida.php');
            exit;
        } else {
            $erro = 'Usuário ou senha incorretos!';
        }
    } else {
        $erro = 'Por favor, preencha todos os campos!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .login-form { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        .erro { color: red; margin: 10px 0; }
        input { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007cba; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login do Sistema</h2>
        
        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div>
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>
        
        <p><small>Usuário: admin | Senha: 123456</small></p>
    </div>
</body>
</html>
