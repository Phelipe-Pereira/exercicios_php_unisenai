<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$nomeArquivo = "dados.txt";
try {
    if (!file_exists($nomeArquivo)) {
        throw new Exception("Arquivo '$nomeArquivo' não encontrado.");
    }
    $conteudo = file_get_contents($nomeArquivo);
    echo "\nConteúdo do arquivo:\n$conteudo";
} catch (Exception $e) {
    echo "\nErro ao abrir arquivo: " . $e->getMessage();
}


?>