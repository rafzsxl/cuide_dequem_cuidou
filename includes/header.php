<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário logado é administrador (coluna 'admin' == true)
$is_admin = !empty($_SESSION['admin']) && $_SESSION['admin'] === true;
?>

<header>
    <a href="../index.php">
        <img src="../images/media/logo.png" alt="Logo" width="10%">
    </a>

    <div>
        <?php if ($is_admin): ?>
            <!-- O que aparece apenas para Administrador (admin = true) -->
            <a href="../admin/users.php"><button class="btn-blue">Visualizar Usuários</button></a>
            <a href="../donations/report.php"><button class="btn-green">Ver Doações</button></a>
        <?php else: ?>
            <!-- O que aparece apenas para Usuários Comuns (admin = false) -->
            <a href="../donations/donate.php">
                <button>Doe Agora</button>
            </a>
        <?php endif; ?>
    </div>

    <a href="../auth/profile.php">
        <img src="../images/media/user_profile.png" alt="Perfil" width="10%">
    </a>

    <input type="checkbox" name="" id="menu-toggle">
    <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <nav class="nav-menu">
        <a href="../index.php">Início</a>
        <a href="../pages/campaigns.php">Campanhas</a>
        <a href="../pages/contact.php">Contatos</a>
        <a href="../pages/partners.php">Parceiros</a>
        <a href="../pages/about.php">Quem Somos?</a>
        <a href="../pages/transparency.php">Transparência</a>
    </nav>
</header>
<hr>