<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<?php include '../includes/header.php'; ?>


<body>
    <main>
        <h1>Entre em sua Conta</h1>
        <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <a href="sign_up.php">Ainda Não Possui Uma Conta?</a><br>
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </form>
                <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $usuario = consulta_user($conexao, $_POST['email']);
                if ($usuario['email'] == $_POST['email'] && $usuario['password'] == $_POST['senha']) {
                    session_start();
                    $_SESSION['id'] = $usuario['id'];
                    header("Location: ../index.php");
                    exit();
                } else{
                    echo "Usuário ou Senha Invalidos";
                    }}
                    ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>