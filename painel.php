<?php
session_start();
require 'conexao.php';

// Proteção simples: se não estiver logado, volta pro login
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit;
}

$mensagem = "";

// Processa o cadastro de produto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'add_produto') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    // Se não enviar imagem, usa a imagem do osso por padrão
    $imagem = !empty($_POST['imagem']) ? $_POST['imagem'] : "https://images.unsplash.com/photo-1601595700762-c0e8fb263629?auto=format&fit=crop&w=400&q=80";

    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $imagem);
    if ($stmt->execute()) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar produto.";
    }
}

// Processa o cadastro de usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'add_usuario') {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha);
    if ($stmt->execute()) {
        $mensagem = "Usuário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro: o usuário já existe.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - MyPet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #fff8f2;">
    <header>
        <div class="logo">🐾 Painel MyPet</div>
        <nav>
            <a href="index.html">Ir para o site</a>
        </nav>
    </header>

    <div class="painel-container">
        <?php if ($mensagem != ""): ?>
            <div style="background: #4CAF50; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <!-- Cadastro de Produtos -->
        <div class="crud-section">
            <h2>Adicionar Novo Produto</h2>
            <form method="POST">
                <input type="hidden" name="acao" value="add_produto">
                <div class="form-group"><label>Nome do Produto</label><input type="text" name="nome" required></div>
                <div class="form-group"><label>Descrição curta</label><input type="text" name="descricao" required></div>
                <div class="form-group"><label>Preço (ex: 49.90)</label><input type="number" step="0.01" name="preco" required></div>
                <div class="form-group"><label>URL da Imagem (Deixe vazio para usar a imagem do Osso)</label><input type="text" name="imagem" placeholder="https://..."></div>
                <button type="submit" class="btn-login" style="width: auto;">Cadastrar Produto</button>
            </form>
        </div>

        <!-- Cadastro de Usuários -->
        <div class="crud-section">
            <h2>Adicionar Novo Usuário Administrador</h2>
            <form method="POST">
                <input type="hidden" name="acao" value="add_usuario">
                <div class="form-group"><label>Usuário</label><input type="text" name="usuario" required></div>
                <div class="form-group"><label>Senha</label><input type="password" name="senha" required></div>
                <button type="submit" class="btn-login" style="width: auto;">Cadastrar Usuário</button>
            </form>
        </div>
    </div>

</body>
</html>