<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>

<?php include '../includes/header.php'; ?>

<body>
    <main>
        <h1>Crie sua Conta</h1>
        <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Insira o seu Nome" required><br>
            <label for="nascimento">Nascimento:</label>
            <input type="date" name="nascimento" id="nascimento" placeholder="Insira a data do seu Nascimento" required><br>
            <input type="submit" value="Criar">
            <input type="reset" value="Limpar">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            criar_user($conexao, $_POST['email'], $_POST['senha'], $_POST['nome'], $_POST['nascimento'], false);
        }       
        ?>

    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>