<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

session_start();

$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário';

session_unset();
session_destroy();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; text-align: center; }
        .logout-message { max-width: 500px; margin: 0 auto; padding: 30px; border: 1px solid #ccc; border-radius: 10px; }
        .success { color: green; font-size: 18px; margin: 20px 0; }
        .login-link { margin-top: 20px; }
        .login-link a { padding: 10px 20px; background: #007cba; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="logout-message">
        <h2>Logout Realizado</h2>
        
        <div class="success">
            <p>✅ Sessão encerrada com sucesso!</p>
            <p>Até logo, <?php echo htmlspecialchars($usuario_nome); ?>!</p>
        </div>
        
        <div class="info">
            <h3>O que foi feito:</h3>
            <ul style="text-align: left; display: inline-block;">
                <li>✅ Variáveis de sessão removidas</li>
                <li>✅ Sessão destruída no servidor</li>
                <li>✅ Cookie de sessão removido</li>
                <li>✅ Dados de autenticação limpos</li>
            </ul>
        </div>
        
        <div class="login-link">
            <a href="login.php">Fazer Login Novamente</a>
        </div>
    </div>
</body>
</html>
