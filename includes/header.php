<?php
// Utiliza __DIR__ para garantir que o PHP busque o arquivo na pasta 'includes'
require_once __DIR__ . '/functions.php';
?>

<header>
    <a href="/cuide_dequem_cuidou/index.php">
        <img src="/cuide_dequem_cuidou/images/media/logo.png" alt="Logo" width="15%">
    </a>

    <div>
        <?php if (isAdmin()): ?>
            <!-- O que aparece apenas para Administrador -->
            <a href= "/cuide_dequem_cuidou/volunteers/view_volunteer.php"><button class="btn-blue">Visualizar Voluntários</button></a>
            <a href="/cuide_dequem_cuidou/donations/view_donations.php"><button class="btn-green">Ver Doações</button></a>
            <a href="/cuide_dequem_cuidou/pages/campaigns.php"><button class="btn-yellow">Campanhas</button></a>
        <?php else: ?>
            <!-- O que aparece apenas para Usuários Comuns -->
            <a href="/cuide_dequem_cuidou/donations/donate.php">
                <button>Doe Agora</button>
            </a>
        <?php endif; ?>
    </div>

    <a href="/cuide_dequem_cuidou/auth/profile.php">
        <img src="/cuide_dequem_cuidou/images/media/user_profile.png" alt="Perfil" width="10%">
    </a>

    <input type="checkbox" name="" id="menu-toggle">
    <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <nav class="nav-menu">
        <a href="/cuide_dequem_cuidou/index.php">Início</a>
        <a href="/cuide_dequem_cuidou/pages/campaigns.php">Campanhas</a>
        <a href="/cuide_dequem_cuidou/pages/contact.php">Contatos</a>
        <a href="/cuide_dequem_cuidou/pages/partners.php">Parceiros</a>
        <a href="/cuide_dequem_cuidou/pages/about.php">Quem Somos?</a>
        <a href="/cuide_dequem_cuidou/pages/transparency.php">Transparência</a>
    </nav>
</header>
