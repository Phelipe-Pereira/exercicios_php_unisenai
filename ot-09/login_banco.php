<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

session_start();

function verificarCredenciais($usuario, $senha) {
    $usuarios = [
        [
            'id' => 1,
            'usuario' => 'admin',
            'senha_hash' => password_hash('123456', PASSWORD_DEFAULT),
            'nome' => 'Administrador',
            'email' => 'admin@sistema.com',
            'nivel' => 'admin'
        ],
        [
            'id' => 2,
            'usuario' => 'usuario',
            'senha_hash' => password_hash('senha123', PASSWORD_DEFAULT),
            'nome' => 'Usuário Padrão',
            'email' => 'usuario@sistema.com',
            'nivel' => 'usuario'
        ]
    ];
    
    foreach ($usuarios as $user) {
        if ($user['usuario'] === $usuario && password_verify($senha, $user['senha_hash'])) {
            return $user;
        }
    }
    
    return false;
}

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    if (!empty($usuario) && !empty($senha)) {
        $usuario_dados = verificarCredenciais($usuario, $senha);
        
        if ($usuario_dados) {
            session_regenerate_id(true);
            
            $_SESSION['usuario_id'] = $usuario_dados['id'];
            $_SESSION['usuario_nome'] = $usuario_dados['nome'];
            $_SESSION['usuario_login'] = $usuario_dados['usuario'];
            $_SESSION['usuario_email'] = $usuario_dados['email'];
            $_SESSION['usuario_nivel'] = $usuario_dados['nivel'];
            $_SESSION['logado'] = true;
            $_SESSION['ultimo_acesso'] = time();
            $_SESSION['login_time'] = time();
            
            $sucesso = 'Login realizado com sucesso! Bem-vindo, ' . $usuario_dados['nome'] . '!';
            
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
    <title>Login com Validação Robusta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .login-form { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        .erro { color: red; margin: 10px 0; padding: 10px; background: #ffe6e6; border-radius: 5px; }
        .sucesso { color: green; margin: 10px 0; padding: 10px; background: #e6ffe6; border-radius: 5px; }
        input { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007cba; color: white; border: none; cursor: pointer; }
        .info { background: #f0f8ff; padding: 15px; margin: 10px 0; border-radius: 5px; font-size: 14px; }
        .usuarios { background: #fff3cd; padding: 15px; margin: 10px 0; border-radius: 5px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login com Validação Robusta</h2>
        
        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($sucesso)): ?>
            <div class="sucesso"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>
        
        <div class="info">
            <h4>Recursos de Segurança:</h4>
            <p>• Senhas criptografadas com password_hash()</p>
            <p>• Validação simulando consulta ao banco</p>
            <p>• Regeneração de sessão após login</p>
            <p>• Armazenamento de dados completos do usuário</p>
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
                <button type="submit">Entrar</button>
            </div>
        </form>
        
        <div class="usuarios">
            <h4>Usuários para Teste:</h4>
            <p><strong>Admin:</strong> usuario: admin | senha: 123456</p>
            <p><strong>Usuário:</strong> usuario: usuario | senha: senha123</p>
        </div>
    </div>
</body>
</html>
