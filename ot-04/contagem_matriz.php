<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$colecao = [
    [
        ["titulo" => "Livro A", "autor" => "Autor A"],
        ["titulo" => "Livro B", "autor" => "Autor B"]
    ],
    [
        ["titulo" => "Livro C", "autor" => "Autor C"],
        ["titulo" => "Livro D", "autor" => "Autor D"],
        ["titulo" => "Livro E", "autor" => "Autor E"]
    ]
];

$totalLivros = 0;

foreach ($colecao as $prateleira) {
    $totalLivros += count($prateleira);
}

echo "Número total de livros: $totalLivros";

?>
