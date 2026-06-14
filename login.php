<?php
// Simulação simples de validação de login
$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Usuário de teste: admin / Senha: 123
    if ($usuario === "admin" && $senha === "123") {
        // Redireciona para o painel administrativo
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyPet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-login">

    <div class="login-box">
        <h2>🐾 Acesso Restrito</h2>
        
        <?php if ($erro != ""): ?>
            <div class="mensagem-erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite 'admin'" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite '123'" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <p style="margin-top: 20px; font-size: 13px;">
            <a href="index.html" style="color: #555; text-decoration: none;">&larr; Voltar ao site</a>
        </p>
    </div>

</body>
</html>