<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doar</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php include '../includes/header.php'; ?>

<body>
    <h1>Doar</h1>
    <main>
        <form action="" method="post">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" placeholder="Insira o Valor" required><br>
            <label type="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a sua senha" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Enviar">
        </form>

    </main>

</body>
<?php include '../includes/footer.php'; ?>

</html>