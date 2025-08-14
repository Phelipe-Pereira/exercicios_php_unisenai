<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário';
$ultimo_acesso = $_SESSION['ultimo_acesso'] ?? time();
$tempo_sessao = time() - $ultimo_acesso;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Área Protegida</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        .header { background: #f0f0f0; padding: 15px; margin-bottom: 20px; }
        .logout { float: right; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Área Protegida</h2>
            <div class="logout">
                <a href="logout.php">Sair</a>
            </div>
        </div>
        
        <div class="info">
            <h3>Bem-vindo, <?php echo htmlspecialchars($usuario_nome); ?>!</h3>
            <p><strong>ID da Sessão:</strong> <?php echo session_id(); ?></p>
            <p><strong>Último Acesso:</strong> <?php echo date('d/m/Y H:i:s', $ultimo_acesso); ?></p>
            <p><strong>Tempo de Sessão:</strong> <?php echo floor($tempo_sessao / 60); ?> minutos</p>
        </div>
        
        <div>
            <h3>Conteúdo Protegido</h3>
            <p>Esta página só pode ser acessada por usuários autenticados.</p>
            <p>Seus dados de sessão estão sendo monitorados e protegidos.</p>
            
            <h4>Informações da Sessão:</h4>
            <ul>
                <li>Status: Autenticado</li>
                <li>Usuário ID: <?php echo $_SESSION['usuario_id']; ?></li>
                <li>Nome: <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></li>
                <li>Login em: <?php echo date('d/m/Y H:i:s', $_SESSION['ultimo_acesso']); ?></li>
            </ul>
        </div>
    </div>
</body>
</html>
