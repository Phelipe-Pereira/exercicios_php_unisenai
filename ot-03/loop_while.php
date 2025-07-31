<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$contador = 0;
$entrada = "";
echo "\nDigite 'PHP' para contar (digite 'sair' para encerrar):\n";
while (true) {
    $entrada = readline("Entrada: ");
    if (strtoupper($entrada) === "PHP") {
        $contador++;
    } elseif (strtolower($entrada) === "sair") {
        break;
    }
}
echo "Você digitou 'PHP' $contador vezes.\n";


?>