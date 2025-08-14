<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$erro = '';
$usuarios = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $idade = trim($_POST['idade'] ?? '');
    
    if (!empty($nome) && !empty($idade)) {
        $stmt = $conexao->prepare("SELECT id, nome, idade, email FROM usuarios WHERE nome LIKE ? AND idade >= ?");
        $nomeBusca = "%$nome%";
        $stmt->bind_param("si", $nomeBusca, $idade);
        
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_assoc()) {
                $usuarios[] = $linha;
            }
        } else {
            $erro = "Erro na consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consulta Segura com Prepared Statements</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 800px; margin: 0 auto; }
        .form { background: #f5f5f5; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .erro { color: red; margin: 10px 0; }
        input { padding: 8px; margin: 5px; }
        button { padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Consulta Segura com Prepared Statements</h2>
        
        <div class="info">
            <h4>Proteção contra SQL Injection:</h4>
            <p>• Usa prepared statements com placeholders (?)</p>
            <p>• Dados são tratados como parâmetros, não como código SQL</p>
            <p>• Escape automático de caracteres especiais</p>
            <p>• Validação de tipos de dados</p>
        </div>
        
        <div class="form">
            <form method="POST" action="">
                <label for="nome">Nome (busca parcial):</label>
                <input type="text" id="nome" name="nome" placeholder="Digite parte do nome">
                
                <label for="idade">Idade mínima:</label>
                <input type="number" id="idade" name="idade" placeholder="Idade mínima">
                
                <button type="submit">Buscar Usuários</button>
            </form>
        </div>
        
        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($usuarios)): ?>
            <h3>Resultados da Busca:</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['idade']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($erro)): ?>
            <p>Nenhum usuário encontrado com os critérios informados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$conexao->close();
?>
