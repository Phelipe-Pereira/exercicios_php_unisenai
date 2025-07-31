<?php
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

function isPrimo($numero) {
    if ($numero <= 1) {
        return "O número $numero não é um número primo.";
    }

    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return "O número $numero não é um número primo.";
        }
    }

    return "O número $numero é um número primo.";
}

$resultado = isPrimo(3);
$segundoResultado = isPrimo(6);

echo $resultado;
echo "\n ----------------- \n";
echo $segundoResultado;
?>
