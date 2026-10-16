<?php require_once '../includes/functions.php';
require_once '../volunteers/verify_volun.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doar</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Doar</h1>
        <form action="" method="post">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" placeholder="Insira o Valor" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a sua senha" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Enviar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Atrela a função os dados recebidos pelo Post
            if (doar($conexao, $_POST['valor'], $_POST['senha'])) {
                header("Location: /cuide_dequem_cuidou/auth/profile.php");
                exit();
            }
            $erro = "Senha inválida ou não foi possível cadastrar.";}
        ?>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>