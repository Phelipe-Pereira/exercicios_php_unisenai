<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

class Produto {
    public $nome;
    public $preco;
    
    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }
    
    public function exibirCaracteristicas() {
        echo "Produto: " . $this->nome . "<br>";
        echo "Preço: R$ " . number_format($this->preco, 2, ',', '.') . "<br>";
    }
}

$produto = new Produto("Notebook", 2500.00);
$produto->exibirCaracteristicas();
?>
