<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

session_start();

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    if (!empty($usuario) && !empty($senha)) {
        if ($usuario === 'admin' && $senha === '123456') {
            session_regenerate_id(true);
            
            $_SESSION['usuario_id'] = 1;
            $_SESSION['usuario_nome'] = $usuario;
            $_SESSION['logado'] = true;
            $_SESSION['ultimo_acesso'] = time();
            $_SESSION['session_id_anterior'] = session_id();
            
            $sucesso = 'Login realizado com sucesso! Sessão regenerada para segurança.';
            
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
    <title>Login com Regeneração de Sessão</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .login-form { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        .erro { color: red; margin: 10px 0; padding: 10px; background: #ffe6e6; border-radius: 5px; }
        .sucesso { color: green; margin: 10px 0; padding: 10px; background: #e6ffe6; border-radius: 5px; }
        input { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007cba; color: white; border: none; cursor: pointer; }
        .info { background: #f0f8ff; padding: 15px; margin: 10px 0; border-radius: 5px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login com Regeneração de Sessão</h2>
        
        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($sucesso)): ?>
            <div class="sucesso"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>
        
        <div class="info">
            <h4>Segurança da Sessão:</h4>
            <p>• ID da sessão será regenerado após login</p>
            <p>• Previne ataques de session fixation</p>
            <p>• Aumenta a segurança da aplicação</p>
        </div>
        
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
                <button type="submit">Entrar com Segurança</button>
            </div>
        </form>
        
        <p><small>Usuário: admin | Senha: 123456</small></p>
    </div>
</body>
</html>
