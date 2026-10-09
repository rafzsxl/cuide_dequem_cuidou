<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $usuario = login_user($conexao, $_POST['email']);

            // A consulta já filtra pelo e-mail, então só precisa conferir a senha
            if ($usuario && $usuario['password'] == $_POST['senha']) {
                $_SESSION['id'] = $usuario['id'];

                // Converte para true/false de verdade (o PostgreSQL pode devolver 't'/'f')
                $_SESSION['admin'] = in_array($usuario['admin'], [true, 't', 1, '1'], true);

                header("Location: ../index.php");
                exit();
            }
            $erro = "Usuário ou senha inválidos";
        }
        ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>