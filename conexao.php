<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql_db = "CREATE DATABASE IF NOT EXISTS mypet";
if ($conn->query($sql_db) === TRUE) {
    $conn->select_db("mypet");
} else {
    die("Erro ao criar banco de dados: " . $conn->error);
}

$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
)";
$conn->query($sql_usuarios);

$sql_produtos = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) NOT NULL
)";
$conn->query($sql_produtos);

$result = $conn->query("SELECT id FROM usuarios LIMIT 1");
if ($result->num_rows == 0) {
    $senha_padrao = password_hash('123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senha_padrao')");
}
?>