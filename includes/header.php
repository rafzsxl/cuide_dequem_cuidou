<?php
// Utiliza __DIR__ para garantir que o PHP busque o arquivo na pasta 'includes'
require_once __DIR__ . '/functions.php';
?>

<header>
    <a href="../index.php">
        <img src="../images/media/logo.png" alt="Logo" width="15%">
    </a>

    <div>
        <?php if (isAdmin()): ?>
            <!-- O que aparece apenas para Administrador -->
            <a href= "../volunteers/view_volunteer.php"><button class="btn-blue">Visualizar Voluntários</button></a>
            <a href="../donations/view_donations.php"><button class="btn-green">Ver Doações</button></a>
            <a href="../pages/campaigns.php"><button class="btn-yellow">Campanhas</button></a>
        <?php else: ?>
            <!-- O que aparece apenas para Usuários Comuns -->
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
        <a href="/index.php">Início</a>
        <a href="../pages/campaigns.php">Campanhas</a>
        <a href="../pages/contact.php">Contatos</a>
        <a href="../pages/partners.php">Parceiros</a>
        <a href="../pages/about.php">Quem Somos?</a>
        <a href="../pages/transparency.php">Transparência</a>
    </nav>
</header>
