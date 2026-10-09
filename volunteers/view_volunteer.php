<?php
require_once '../includes/functions.php';
require_once '../admin/verify_adm.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Voluntários</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php include '../includes/header.php'; ?>
<body>
    <h1>Todos os Voluntários</h1>
    <a href="../volunteers\delete_volunteer.php">
        <button>Delete Um Voluntários</button>
    </a>
    <hr>
    <main>
        <?php relatorio_volun($conexao); ?><br>
    </main>
</body>
<?php include '../includes/footer.php'; ?>

</html>