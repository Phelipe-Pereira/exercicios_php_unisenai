<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$letras = ["a", "b", "c", "a", "d", "e", "a", "f"];
$contador = 0;

foreach ($letras as $letra) {
    if ($letra === "a") {
        $contador++;
    }
}

echo "A letra 'a' aparece $contador vezes.";

?>
