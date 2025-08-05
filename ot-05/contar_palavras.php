<?php 
/*
    Data: 04/08/2025
    Nome: Phelipe Leandro Pereira
*/

$texto = file_get_contents("paragrafo.txt");
$palavras = str_word_count($texto, 0);
echo "Número de palavras no arquivo: $palavras\n";
?>
