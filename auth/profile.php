<?php 
require_once 'verify_user.php';
require_once '../includes/functions.php'; 
// Verifica se a ação de logout foi acionada via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    // Limpa e destrói a sessão
    $_SESSION = array();
    session_destroy();
    
    // Redireciona para a tela de login
    header("Location: ../auth/login.php");
    exit;
}
?>
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
        <img src="../images/media/user_profile.png" alt="Logo" width="10%">
        <div class="actions">
            <a href="../auth/edit.php">
                <button>Editar</button>
            </a>
            <!-- Formulário para substituir o arquivo logout.php excluído -->
            <form action="" method="POST" style="display: inline;">
                <input type="hidden" name="action" value="logout">
                <button type="submit">Fazer Logout</button>
            </form>

            <?php if (!isAdmin($conexao, $_SESSION['id'])): ?>
                <a href="../auth/delete.php">
                    <button>Deletar Conta</button>
                </a>
            <?php endif; ?>
        </div>
        <br>
        <div class="Contributions">

            <a href="../donations/donate.php">
                <button>Contribua</button>
            </a>
            <?php if (!id_volun($conexao, $_SESSION['id'])): ?>
                <a href="../volunteers/volunteer.php">
                    <button>Voluntariar-se</button>
                </a>
            <?php endif; ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>