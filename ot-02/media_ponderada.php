<?php
/*
    Data: 30/07/2025
    Nome: Phelipe Leandro Pereira
*/

$notas = array();
$pesos = array();

function calcularMediaPonderada($notas, $pesos) {
    if (count($notas) !== count($pesos)) {
    return "Erro: quantidade de notas e pesos deve ser igual.";
    }
    
    $somaDasMultiplicacoes = 0;
    $somaDosPesos = 0;

    for ($i = 0; $i < count($notas); $i++) {
        $somaDasMultiplicacoes += $notas[$i] * $pesos[$i];
        $somaDosPesos += $pesos[$i];
    }

    if ($somaDosPesos == 0) {
        return 0;
    }

    return $somaDasMultiplicacoes / $somaDosPesos;
}

$notas = [7, 8];
$pesos = [2, 3]; // erro aqui

$resultado = calcularMediaPonderada($notas, $pesos);
echo $resultado;
?>
