<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

$usuarios = [
    ["nome" => "Ana", "email" => "ana@email.com"],
    ["nome" => "Bruno", "email" => "bruno@email.com"],
    ["nome" => "Carlos", "email" => "carlos@email.com"]
];

echo "\n<table border='1'>";
echo "<tr><th>Nome</th><th>Email</th></tr>";
foreach ($usuarios as $usuario) {
    echo "<tr>";
    foreach ($usuario as $valor) {
        echo "<td>$valor</td>";
    }
    echo "</tr>";
}
echo "</table>\n";


?>