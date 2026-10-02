<?php
require_once '../database/connect.php';

// Funçoes de Autenticação

// Fução para Criar Usuário
function criar_user($conexao, $email, $senha, $nome, $nascimento, $admin = false)
{
    $sql = "INSERT INTO users (email, password, nome, nascimento, admin) VALUES (:email, :senha, :nome , :nascimento, :admin)";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha",  $senha);
        $stmt->bindParam("nome",  $nome); // binParam vincula uma variável e não um valor fixo
        $stmt->bindParam(":nascimento",  $nascimento);

        //PDO exige que booleanos sejam passados com o tipo explícito PDO::PARAM_BOOL 
        $stmt->bindValue(":admin", $admin, PDO::PARAM_BOOL); //bindValue Vincula um valor fixo

        $stmt->execute();
        echo "Usuário Criado com Sucesso";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Função de Login de Usuário
function consulta_user($conexao, $email)
{
    $sql = "SELECT id, email, password FROM users WHERE email = :email";
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


// Fução para Editar Usuário
function editar_user($conexao, $email, $senha, $nome, $nascimento, $admin = false)
{
    $sql = "UPDATE users SET email = :email, password = :senha, nome = :nome, nascimento = :nascimento, admin = : admin";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha",  $senha);
        $stmt->bindParam("nome",  $nome);
        $stmt->bindParam(":nascimento",  $nascimento);
        $stmt->bindValue(":admin", $admin, PDO::PARAM_BOOL);

        $stmt->execute();
        echo "Usuário Editado com Sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Fução para Criar Voluntário
function criar_volun($conexao, $cpf, $telefone, $data_volun, $user_id)
{
    $sql = "INSERT INTO voluntarios (cpf, telefone, data_volun, user_id) VALUES (:cpf, :telefone, :data_volun, :user_id)";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":data_volun", $data_volun);
        $stmt->bindParam(":telefone",  $telefone);
        $stmt->bindParam(":data_volun",  $data_volun);
        $stmt->bindParam(":user_id",  $user_id);

        $stmt->execute();
        echo "Usuário Criado com Sucesso";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
