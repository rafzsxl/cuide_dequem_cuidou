<?php require_once '../includes/functions.php';
require_once 'verify_user.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
</head>

<?php include '../includes/header.php'; ?>

<body>
    <main>
        <h1>Apagar Conta</h1>
        <form action="" method="post">
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <input type="submit" value="Apagar">
            <input type="reset" value="Limpar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (delete_user($conexao, $_POST['senha'])) {
                header("Location: ../index.php");
                exit();
            }
            $erro = "Senha inválida";
        }
        ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>