<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

interface Veiculo {
    public function mover();
}

class Carro implements Veiculo {
    public function mover() {
        return "O carro está rodando pelas ruas.";
    }
}

class Aviao implements Veiculo {
    public function mover() {
        return "O avião está voando pelos céus.";
    }
}

function testarMovimento(Veiculo $veiculo) {
    echo $veiculo->mover() . "<br>";
}

$carro = new Carro();
$aviao = new Aviao();

testarMovimento($carro);
testarMovimento($aviao);
?>
