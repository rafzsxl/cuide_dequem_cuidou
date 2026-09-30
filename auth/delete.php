<?php require_once '../includes/functions.php'; 
require_once __DIR__ . 'verifica_user.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
</head>

<?php include '../includes/header.php'; ?>

<hr>

<body>
    <main>
        <h1>Apagar Conta</h1>
        <form action="" method="post">
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <input type="submit" value="Apagar">
            <input type="reset" value="Limpar">
        </form>

    </main>
</body>
<hr>
<?php include '../includes/footer.php'; ?>

</html>