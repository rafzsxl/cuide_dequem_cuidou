<?php 
require_once '../includes/functions.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanhas</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Campanhas</h1>

        <!-- Caso o Usuário não seja admin ele não será capaz de visualizar os botões abaixo -->
        <?php if (isAdmin()): ?>
            <a href="/cuide_dequem_cuidou/admin/create_campaign.php"><button class="btn-green">Criar Campanha</button></a>
            <a href="/cuide_dequem_cuidou/admin/update_campaign.php"><button class="btn-blue">Editar Campanha</button></a>
            <a href="/cuide_dequem_cuidou/admin/delete_campaign.php"><button class="btn-yellow">Apagar Campanha</button></a><hr>
        <?php endif; ?>

        <br>
        <?php campanhas($conexao); ?>
        
        <h4>EM BREVE</h4>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>