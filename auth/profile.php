<?php require_once 'verify_user.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Conta</title>
</head>

<?php include '../includes/header.php'; ?>

<hr>

<body>
    <main>

        <img src="../images/user_profile.png" alt="Logo" width="10%">
        
        <a href="edit.php">
            <button>Editar</button>
        </a>
       <a href="logout.php">
            <button>Fazer Logout</button>
        </a>
        
        <br>

        <a href="../donations/donate.php">
            <button>Contribua</button>
        </a>
        <a href="../volunteers/volunteer.php">
            <button>Voluntariar-se</button>
        </a>
        
    </main>
</body>
<hr>
<?php include '../includes/footer.php'; ?>

</html>