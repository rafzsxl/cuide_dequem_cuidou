<?php 
require_once '../includes/functions.php';
// Caso não haja uma sessão iniciada ele a inicia
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
// Caso não haja uma conta conectada a esta sessão ele leva o Uusário para a Tela de Login
if(!isset($_SESSION['id'])){
    header("Location: /cuide_dequem_cuidou/auth/login.php");
    exit();
}
// Caso haja uma conta conectada a esta sessão, mas esta conta não seja um voluntário ele leva o Uusário para a Tela de Voluntariar-se
if (!id_volun($conexao, $_SESSION['id'])){
    header("Location: /cuide_dequem_cuidou/volunteers/volunteer.php");
    exit();
}
?>