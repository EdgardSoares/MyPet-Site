<?php
header('Content-Type: application/json');
require 'conexao.php';

$result = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = [];
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

echo json_encode($produtos);
?>