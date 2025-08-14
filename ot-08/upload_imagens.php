<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['imagem'])) {
    $arquivo = $_FILES['imagem'];
    $tiposPermitidos = ['image/jpeg', 'image/png'];
    $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
    
    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        if (in_array($arquivo['type'], $tiposPermitidos)) {
            if ($arquivo['size'] <= $tamanhoMaximo) {
                $diretorioDestino = 'uploads/';
                if (!is_dir($diretorioDestino)) {
                    mkdir($diretorioDestino, 0755, true);
                }
                
                $nomeArquivo = uniqid() . '_' . $arquivo['name'];
                $caminhoCompleto = $diretorioDestino . $nomeArquivo;
                
                if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
                    echo "<h2>Upload realizado com sucesso!</h2>";
                    echo "<p>Arquivo: " . htmlspecialchars($nomeArquivo) . "</p>";
                    echo "<p>Tamanho: " . number_format($arquivo['size'] / 1024, 2) . " KB</p>";
                    echo "<img src='$caminhoCompleto' style='max-width: 300px;'>";
                } else {
                    echo "<p style='color: red;'>Erro ao mover arquivo.</p>";
                }
            } else {
                echo "<p style='color: red;'>Arquivo muito grande. Máximo 5MB.</p>";
            }
        } else {
            echo "<p style='color: red;'>Tipo de arquivo não permitido. Apenas JPEG e PNG.</p>";
        }
    } else {
        echo "<p style='color: red;'>Erro no upload: " . $arquivo['error'] . "</p>";
    }
    echo "<a href='upload_imagens.php'>Voltar ao formulário</a>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload de Imagens</title>
</head>
<body>
    <h2>Upload de Imagem</h2>
    <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="imagem">Selecione uma imagem (JPEG ou PNG, máx. 5MB):</label><br>
            <input type="file" id="imagem" name="imagem" accept="image/jpeg,image/png" required>
        </p>
        <p>
            <input type="submit" value="Enviar Imagem">
        </p>
    </form>
</body>
</html>
<?php
}
?>
