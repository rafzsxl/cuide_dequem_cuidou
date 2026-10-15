<?php require_once 'verify_user.php';
require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Conta</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <img src="/cuide_dequem_cuidou/images/media/user_profile.png" alt="Logo" width="10%">

        <div class="actions">

            <a href="/cuide_dequem_cuidou/auth/edit.php">
                <button>Editar</button>
            </a>
            <a href="/cuide_dequem_cuidou/auth/logout.php">
                <button>Fazer Logout</button>
            </a>
            <?php if (!isAdmin($conexao, $_SESSION['id'])): ?>
                <a href="/cuide_dequem_cuidou/auth/delete.php">
                    <button>Deletar Conta</button>
                </a>
            <?php endif; ?>
        </div>
        <br>
        <div class="Contributions">

            <a href="/cuide_dequem_cuidou/donations/donate.php">
                <button>Contribua</button>
            </a>
            <?php if (!id_volun($conexao, $_SESSION['id'])): ?>
                <a href="/cuide_dequem_cuidou/volunteers/volunteer.php">
                    <button>Voluntariar-se</button>
                </a>
            <?php endif; ?>
        </div>

    </main>
    <?php include '../includes/footer.php'; ?>
</body>

</html>