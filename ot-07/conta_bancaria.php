<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

class ContaBancaria {
    private $saldo;
    private $numeroConta;
    
    public function __construct($numeroConta, $saldoInicial = 0) {
        $this->numeroConta = $numeroConta;
        $this->saldo = $saldoInicial;
    }
    
    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            return "Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado. Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.');
        }
        return "Valor inválido para depósito.";
    }
    
    public function sacar($valor) {
        if ($valor > 0 && $this->saldo >= $valor) {
            $this->saldo -= $valor;
            return "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado. Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.');
        }
        return "Saldo insuficiente ou valor inválido.";
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
    
    public function getNumeroConta() {
        return $this->numeroConta;
    }
}

$conta = new ContaBancaria("12345-6", 1000.00);

echo "Conta: " . $conta->getNumeroConta() . "<br>";
echo $conta->depositar(500.00) . "<br>";
echo $conta->sacar(200.00) . "<br>";
echo $conta->sacar(2000.00) . "<br>";
?>
