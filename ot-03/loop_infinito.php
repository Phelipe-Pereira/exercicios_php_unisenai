<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

echo "\nNúmeros pares de 2 a 10 (exceto 6):\n";
for ($i = 2; ; $i += 2) {
    if ($i == 6) continue;
    if ($i > 10) break;
    echo "$i\n";
}


?>