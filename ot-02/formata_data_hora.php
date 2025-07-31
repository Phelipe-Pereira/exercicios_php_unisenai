<?php 
/*
    Data: 31/07/2025
    Nome: Phelipe Leandro Pereira
*/

function formatarTimestamp($timestamp) {
    return date("d/m/Y H:i:s", $timestamp);
}

$timestamp = time();
echo "Data formatada: " . formatarTimestamp($timestamp);


?>