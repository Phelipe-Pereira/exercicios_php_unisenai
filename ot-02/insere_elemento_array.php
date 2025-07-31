<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$cores = ["Vermelho", "Verde", "Azul"];
function adicionaElementoNoArray (&$array, $elemento ) {
    return array_push($array, $elemento);
}

echo "Lista antes da alteração \n";
for ($i = 0; $i < count($cores); $i++) {
    echo $cores[$i];
    echo "\n";
}

adicionaElementoNoArray($cores, "Branco");
echo "\nLista depois da alteração \n";
for ($i = 0; $i < count($cores); $i++) {
    echo $cores[$i];
    echo "\n";
}


?>