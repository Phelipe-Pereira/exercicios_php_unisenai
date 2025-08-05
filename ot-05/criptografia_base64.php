<?php 
/*
    Data: 04/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conteudo = file_get_contents("sensivel.txt");
$criptografado = base64_encode($conteudo);
file_put_contents("sensivel_criptografado.txt", $criptografado);
?>
