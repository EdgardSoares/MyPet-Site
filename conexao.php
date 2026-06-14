<?php
$host = 'localhost';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS mypet");
$conn->select_db("mypet");

$conn->query("CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
)");

$result = $conn->query("SELECT * FROM usuarios WHERE usuario = 'admin'");
if ($result->num_rows == 0) {
    $senha_hash = password_hash('123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senha_hash')");
}

$conn->query("CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255)
)");
?>