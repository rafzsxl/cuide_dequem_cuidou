<?php
require_once '../database/connect.php';

// Funções para Login
function cadastra_user($conexao, $email, $senha)
{
    $sql = "INSERT INTO usuario (email, senha) VALUES(:email, :senha)";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->execute();
        echo "Usuário Cadastrado com Sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

}

function consulta_user($conexao, $email)
{
    $sql = "SELECT id, email, senha FROM usuario WHERE email = :email";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;

    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
}

?>