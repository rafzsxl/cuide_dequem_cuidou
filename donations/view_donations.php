<?php 
require_once '../includes/functions.php';
require_once '../admin/verify_adm.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Doações</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <hr>
    <main>
        <?php relatorio_doacoes($conexao); ?>
    </main>
    <?php  include '../includes/footer.php'; ?>

</body>

</html>