<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];
    $tiposPermitidos = ['application/pdf', 'text/plain', 'application/msword'];
    $tamanhoMaximo = 10 * 1024 * 1024; // 10MB
    
    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        if (in_array($arquivo['type'], $tiposPermitidos)) {
            if ($arquivo['size'] <= $tamanhoMaximo) {
                $diretorioSeguro = 'arquivos_seguros/';
                if (!is_dir($diretorioSeguro)) {
                    mkdir($diretorioSeguro, 0755, true);
                }
                
                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeUnico = uniqid() . '_' . time() . '.' . $extensao;
                $caminhoCompleto = $diretorioSeguro . $nomeUnico;
                
                if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
                    echo "<h2>Arquivo armazenado com segurança!</h2>";
                    echo "<p><strong>Nome original:</strong> " . htmlspecialchars($arquivo['name']) . "</p>";
                    echo "<p><strong>Nome único:</strong> " . htmlspecialchars($nomeUnico) . "</p>";
                    echo "<p><strong>Tamanho:</strong> " . number_format($arquivo['size'] / 1024, 2) . " KB</p>";
                    echo "<p><strong>Tipo:</strong> " . htmlspecialchars($arquivo['type']) . "</p>";
                    echo "<p><strong>Data de upload:</strong> " . date('d/m/Y H:i:s') . "</p>";
                } else {
                    echo "<p style='color: red;'>Erro ao mover arquivo para diretório seguro.</p>";
                }
            } else {
                echo "<p style='color: red;'>Arquivo muito grande. Máximo 10MB.</p>";
            }
        } else {
            echo "<p style='color: red;'>Tipo de arquivo não permitido. Apenas PDF, TXT e DOC.</p>";
        }
    } else {
        echo "<p style='color: red;'>Erro no upload: " . $arquivo['error'] . "</p>";
    }
    echo "<a href='armazenamento_seguro.php'>Voltar ao formulário</a>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Armazenamento Seguro de Arquivos</title>
</head>
<body>
    <h2>Upload Seguro de Arquivos</h2>
    <p>Tipos permitidos: PDF, TXT, DOC (máximo 10MB)</p>
    <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="arquivo">Selecione um arquivo:</label><br>
            <input type="file" id="arquivo" name="arquivo" accept=".pdf,.txt,.doc" required>
        </p>
        <p>
            <input type="submit" value="Enviar Arquivo">
        </p>
    </form>
</body>
</html>
<?php
}
?>
