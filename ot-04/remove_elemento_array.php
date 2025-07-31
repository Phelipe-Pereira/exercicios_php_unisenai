<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$paises = ["Brasil", "Argentina", "Chile", "Peru", "Uruguai"];
unset($paises[2]);
$paises = array_values($paises); // Reindexar o array

print_r($paises);

?>
