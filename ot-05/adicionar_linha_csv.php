<?php 
/*
    Data: 04/08/2025
    Nome: Phelipe Leandro Pereira
*/

$novaLinha = ["2025-08-04", "250.75", "Produto Teste"];
$handle = fopen("vendas.csv", "a");
fputcsv($handle, $novaLinha);
fclose($handle);
?>
