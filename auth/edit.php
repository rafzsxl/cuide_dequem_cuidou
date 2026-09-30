<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<?php include '../includes/header.php'; ?>

<hr>

<body>
    <main>
        <h1>Edite as suas Informações</h1>
        <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <label for="">CPF:</label>
            <input type="text" name="cpf" id="cpf" placeholder="Insira o CPF" required><br>
            <label for="">Telefone:</label>
            <input type="text" name="telefone" id="telefone" placeholder="Insira o Telefone" required><br>
            <input type="submit" value="Editar">
            <input type="reset" value="Limpar">
        </form>

    </main>
</body>
<hr>
<?php include '../includes/footer.php'; ?>

</html>