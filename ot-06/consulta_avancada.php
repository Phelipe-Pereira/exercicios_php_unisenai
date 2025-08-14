<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

$conexao = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$consulta = "SELECT u.nome, u.idade, p.titulo, p.data_criacao 
             FROM usuarios u 
             INNER JOIN posts p ON u.id = p.usuario_id 
             WHERE u.idade > 25 
             ORDER BY p.data_criacao DESC";

$resultado = $conexao->query($consulta);

if ($resultado->num_rows > 0) {
    echo "<h2>Posts de Usuários com mais de 25 anos</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>Idade</th><th>Título do Post</th><th>Data</th></tr>";
    
    while ($linha = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha['nome']) . "</td>";
        echo "<td>" . $linha['idade'] . "</td>";
        echo "<td>" . htmlspecialchars($linha['titulo']) . "</td>";
        echo "<td>" . $linha['data_criacao'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum resultado encontrado.";
}

$conexao->close();
?>
