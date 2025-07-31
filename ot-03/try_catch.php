<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

function dividir($a, $b) {
    try {
        if ($b == 0) {
            throw new Exception("Divisão por zero não é permitida.");
        }
        return $a / $b;
    } catch (Exception $e) {
        return "Erro: " . $e->getMessage();
    }
}

echo "\nDivisão: " . dividir(10, 2) . "\n";
echo "Divisão com erro: " . dividir(5, 0) . "\n";


?>