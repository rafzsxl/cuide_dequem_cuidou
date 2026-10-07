<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Só passa quem tem admin = true na sessão
if (empty($_SESSION['admin'])) {
    http_response_code(403);
    exit("Acesso restrito a administradores.");
}
?>