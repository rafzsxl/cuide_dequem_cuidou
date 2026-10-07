<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voluntarie-se</title>
</head>

<?php include '../includes/header.php'; ?>



<body>
    <main>
        <h1>Voluntarie-se</h1>
        <form action="" method="post">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" placeholder="Insira o seu CPF" required><br>
            <label type="senha">Telefone:</label>
            <input type="text" name="telefone" id="telefone" placeholder="Insira o seu Telefone" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Senha da sua Conta" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Cadastrar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Agora passa os 4 argumentos, incluindo a senha
            if (criar_volun($conexao, $_POST['cpf'], $_POST['telefone'], $_POST['senha'])) {
                header("Location: ../auth/profile.php");
                exit();
            }
            $erro = "Senha inválida ou você já é voluntário.";
        }
        ?>
        ?>
    </main>
</body>


<?php include '../includes/footer.php'; ?>

</html>