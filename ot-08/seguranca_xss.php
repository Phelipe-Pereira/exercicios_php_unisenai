<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

function sanitizarDados($dados) {
    return htmlspecialchars($dados, ENT_QUOTES, 'UTF-8');
}

$mensagem = '';
$comentarios = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');
    
    if (!empty($nome) && !empty($comentario)) {
        $comentarios[] = [
            'nome' => $nome,
            'comentario' => $comentario,
            'data' => date('d/m/Y H:i:s')
        ];
        $mensagem = "Comentário adicionado com sucesso!";
    } else {
        $mensagem = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Proteção contra XSS</title>
    <style>
        .comentario { border: 1px solid #ccc; margin: 10px 0; padding: 10px; }
        .nome { font-weight: bold; color: #333; }
        .data { color: #666; font-size: 0.9em; }
        .mensagem { color: green; margin: 10px 0; }
        .erro { color: red; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Sistema de Comentários com Proteção XSS</h2>
    
    <?php if (!empty($mensagem)): ?>
        <div class="<?php echo strpos($mensagem, 'sucesso') !== false ? 'mensagem' : 'erro'; ?>">
            <?php echo sanitizarDados($mensagem); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <p>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required>
        </p>
        <p>
            <label for="comentario">Comentário:</label><br>
            <textarea id="comentario" name="comentario" rows="4" cols="50" required></textarea>
        </p>
        <p>
            <input type="submit" value="Adicionar Comentário">
        </p>
    </form>
    
    <h3>Comentários:</h3>
    <?php if (!empty($comentarios)): ?>
        <?php foreach ($comentarios as $com): ?>
            <div class="comentario">
                <div class="nome"><?php echo sanitizarDados($com['nome']); ?></div>
                <div class="data"><?php echo sanitizarDados($com['data']); ?></div>
                <div><?php echo sanitizarDados($com['comentario']); ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum comentário ainda.</p>
    <?php endif; ?>
    
    <hr>
    <h4>Teste de Segurança XSS:</h4>
    <p>Tente inserir este código malicioso no comentário:</p>
    <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code>
    <p>O código será exibido como texto, não executado!</p>
</body>
</html>
