<?php
// Configuração da base de dados
$host = "localhost"; // Endereço do servidor
$username = "root";  // Nome de utilizador 
$password = "";      // Palavra-passe
$dbname = "gestaoled"; // Nome da base de dados

// Criar a ligação
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar se a ligação falhou
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

// Definir charset para garantir compatibilidade
$conn->set_charset("utf8mb4");
?>
