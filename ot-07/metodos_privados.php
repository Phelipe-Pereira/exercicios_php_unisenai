<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

class Cliente {
    private $senha;
    private $nome;
    
    public function __construct($nome) {
        $this->nome = $nome;
    }
    
    public function setSenha($senha) {
        if (strlen($senha) >= 6) {
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);
            return true;
        }
        return false;
    }
    
    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }
    
    public function getNome() {
        return $this->nome;
    }
}

$cliente = new Cliente("João Silva");

if ($cliente->setSenha("123456")) {
    echo "Senha definida com sucesso para " . $cliente->getNome() . "<br>";
    
    if ($cliente->verificarSenha("123456")) {
        echo "Senha verificada corretamente!<br>";
    }
} else {
    echo "Senha muito curta!<br>";
}
?>
