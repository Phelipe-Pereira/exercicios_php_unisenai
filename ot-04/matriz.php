<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$tabela = [];

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        $tabela[$i][$j] = $i * $j;
    }
}

echo "Resultado da multiplicação de 3 por 4: " . $tabela[3][4];

?>
