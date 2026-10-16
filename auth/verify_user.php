<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
// Caso não haja iniciado uma sessão o usuário é levado para a página de login 
if(!isset($_SESSION['id'])){
    header("Location: /cuide_dequem_cuidou/auth/login.php");
    exit();
}
?>