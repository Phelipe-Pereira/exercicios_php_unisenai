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
            'data' => date('d/m/Y H:i:s'),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Desconhecido'
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
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 800px; margin: 0 auto; }
        .form { background: #f5f5f5; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .comentario { border: 1px solid #ddd; margin: 10px 0; padding: 15px; border-radius: 5px; }
        .nome { font-weight: bold; color: #333; }
        .data { color: #666; font-size: 0.9em; }
        .ip { color: #999; font-size: 0.8em; }
        input, textarea { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .teste { background: #fff3cd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .mensagem { color: green; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sistema de Comentários com Proteção XSS</h2>
        
        <div class="info">
            <h4>Proteção contra Cross-Site Scripting (XSS):</h4>
            <p>• Todos os dados são sanitizados com htmlspecialchars()</p>
            <p>• Caracteres especiais são convertidos em entidades HTML</p>
            <p>• Scripts maliciosos são neutralizados</p>
            <p>• Dados são exibidos como texto, não como código</p>
        </div>
        
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?php echo sanitizarDados($mensagem); ?></div>
        <?php endif; ?>
        
        <div class="form">
            <form method="POST" action="">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div>
                    <label for="comentario">Comentário:</label>
                    <textarea id="comentario" name="comentario" rows="4" required></textarea>
                </div>
                <div>
                    <button type="submit">Adicionar Comentário</button>
                </div>
            </form>
        </div>
        
        <div class="teste">
            <h4>Teste de Segurança XSS:</h4>
            <p>Tente inserir este código malicioso no comentário:</p>
            <code>&lt;script&gt;alert('XSS Attack!')&lt;/script&gt;</code>
            <p>O código será exibido como texto, não executado!</p>
        </div>
        
        <h3>Comentários:</h3>
        <?php if (!empty($comentarios)): ?>
            <?php foreach ($comentarios as $com): ?>
                <div class="comentario">
                    <div class="nome"><?php echo sanitizarDados($com['nome']); ?></div>
                    <div class="data"><?php echo sanitizarDados($com['data']); ?></div>
                    <div class="ip">IP: <?php echo sanitizarDados($com['ip']); ?></div>
                    <div style="margin-top: 10px;"><?php echo sanitizarDados($com['comentario']); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum comentário ainda.</p>
        <?php endif; ?>
        
        <div class="info">
            <h4>Como funciona a proteção:</h4>
            <p><strong>Antes da sanitização:</strong> &lt;script&gt;alert('XSS')&lt;/script&gt;</p>
            <p><strong>Após htmlspecialchars():</strong> &amp;lt;script&amp;gt;alert('XSS')&amp;lt;/script&amp;gt;</p>
            <p>O navegador exibe o texto literal, não executa o script.</p>
        </div>
    </div>
</body>
</html>
