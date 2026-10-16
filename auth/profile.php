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
        <img src="/cuide_dequem_cuidou/images/media/user_profile.png" alt="Logo" width="10%">
        <div class="actions">

            <a href="/cuide_dequem_cuidou/auth/edit.php">
                <button>Editar</button>
            </a>
            
            <!-- Formulário para substituir o arquivo logout.php excluído e para fazer logou -->
            <form action="" method="POST" style="display: inline;">
                <input type="hidden" name="action" value="logout">
                <button type="submit">Fazer Logout</button>
            </form>

            <!--Chama o Php e defne que se o usuário não for admin, o botão aparece, caso o contrario não -->
            <?php if (!isAdmin($conexao, $_SESSION['id'])): ?>
                <a href="/cuide_dequem_cuidou/auth/delete.php">
                    <button>Deletar Conta</button>
                </a>
            <!--Fecha o If-->
            <?php endif; ?>
        </div>
        <br>
        <div class="Contributions">

            <a href="/cuide_dequem_cuidou/donations/donate.php">
                <button>Contribua</button>
            </a>
        '<!--Mesma coisa do If do Admin, mas com id_voluntario que verifica se o usuário é ou não voluntário, caso seja o botão a seguir não aparece-->'
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