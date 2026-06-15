<?php
require 'conexao.php';

$result = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - MyPet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container-produtos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card-produto {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
        }
        .card-produto:hover {
            transform: translateY(-5px);
        }
        .card-produto img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card-produto h3 {
            margin: 15px 0 10px;
            color: #333;
        }
        .card-produto p {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            min-height: 40px;
        }
        .preco {
            font-size: 22px;
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 15px;
        }
        .btn-comprar {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-comprar:hover {
            background-color: #ff4f4f;
        }
    </style>
</head>
<body style="background-color: #fff8f2; margin: 0;">

    <header style="background-color: #fff; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-around; align-items: center;">
        <div style="font-size: 24px; font-weight: bold; color: #ff6b6b;">🐾 Loja MyPet</div>
        <nav>
            <a href="index.html" style="text-decoration: none; color: #333; margin-right: 20px;">Início</a>
            <a href="login.php" style="text-decoration: none; color: #333;">Acesso Admin</a>
        </nav>
    </header>

    <h1 style="text-align: center; color: #333; margin-top: 40px;">Nossos Produtos</h1>

    <div class="container-produtos">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($produto = $result->fetch_assoc()): ?>
                <div class="card-produto">
                    <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                    <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                    <div class="preco">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </div>
                    <button class="btn-comprar">Comprar</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; color: #777; font-size: 18px; width: 100%;">
                Nenhum produto cadastrado no momento. 🐶
            </div>
        <?php endif; ?>
    </div>

</body>
</html>