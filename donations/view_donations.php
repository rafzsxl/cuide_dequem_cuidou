<?php
require_once '../includes/functions.php';
require_once '../admin/verify_adm.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Doações</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <h1>Todas as Doações</h1>
    <hr>
    <main>
        <?php relatorio_doacoes($conexao); ?>
    </main>
    <h3>Total Arrecadado:</h3>
    <?php total_doacoes($conexao); ?><br>
</body>
<?php include '../includes/footer.php'; ?>

</html>