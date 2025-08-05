<?php 
/*
    Data: 04/08/2025
    Nome: Phelipe Leandro Pereira
*/

$vendas = [];
if (($handle = fopen("vendas.csv", "r")) !== false) {
    while (($dados = fgetcsv($handle, 1000, ",")) !== false) {
        $vendas[] = (float)$dados[1]; // supondo que a 2ª coluna seja o valor
    }
    fclose($handle);
    if (count($vendas) > 0) {
        $media = array_sum($vendas) / count($vendas);
        echo "Média de vendas: R$ " . number_format($media, 2, ",", ".") . "\n";
    }
}
?>
