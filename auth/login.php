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
            <input type="email" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <a href="sign_up.php">Ainda Não Possui Uma Conta?</a><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Entrar">
        </form>
        <!--Chama o Php e executa a função abaixo caso o metodo requisitado pela página seja o post e não tenha iniciado sessão-->
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

                // Por ultimo volta para a Página Inicial caso tenha dado certo
                header("Location: /cuide_dequem_cuidou/index.php");
                exit();
            }
            // Caso não de certo ele imprime a mensagem de erro
            $erro = "Usuário ou senha inválidos";
        }
        ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>