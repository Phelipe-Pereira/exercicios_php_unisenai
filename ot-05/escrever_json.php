<?php 
/*
    Data: 04/08/2025
    Nome: Phelipe Leandro Pereira
*/

$produto = [
    "nome" => "Notebook Gamer",
    "marca" => "Dell",
    "preco" => 4500.00,
    "estoque" => 15
];
file_put_contents("produto.json", json_encode($produto, JSON_PRETTY_PRINT));
?>
