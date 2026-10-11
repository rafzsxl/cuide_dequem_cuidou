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
<?php include '../includes/header.php'; ?>
<body>
    <main>
        <img src="../images/media/user_profile.png" alt="Logo" width="10%">

        <a href="edit.php">
            <button>Editar</button>
        </a>
        <a href="logout.php">
            <button>Fazer Logout</button>
        </a>
        <a href="delete.php">
            <button>Deletar Conta</button>
        </a>

        <br>

        <a href="../donations/donate.php">
            <button>Contribua</button>
        </a>
        <?php if (!id_volun($conexao, $_SESSION['id'])): ?>
            <a href="../volunteers/volunteer.php">
                <button>Voluntariar-se</button>
            </a>
        <?php endif; ?>

    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>