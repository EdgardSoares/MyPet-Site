<?php
$host = "localhost";
$user = "root";
$pass = ""; // No XAMPP, a senha geralmente é vazia

// 1. Conecta ao MySQL
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// 2. Cria o banco de dados 'mypet' caso não exista e o seleciona
$sql_db = "CREATE DATABASE IF NOT EXISTS mypet";
if ($conn->query($sql_db) === TRUE) {
    $conn->select_db("mypet");
} else {
    die("Erro ao criar banco de dados: " . $conn->error);
}

// 3. Cria a tabela de usuários
$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
)";
$conn->query($sql_usuarios);

// 4. Cria a tabela de produtos
$sql_produtos = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) NOT NULL
)";
$conn->query($sql_produtos);

// 5. Garante que exista pelo menos um administrador padrão (admin / 123)
$result = $conn->query("SELECT id FROM usuarios LIMIT 1");
if ($result->num_rows == 0) {
    $senha_padrao = password_hash('123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senha_padrao')");
}
?>