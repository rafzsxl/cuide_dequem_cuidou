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

// Função para o Logout de Usuários
function logout_user($conexao, $senha)
{
    // Recebe o id do usuário Logado e armazena na variável $id
    $id = $_SESSION['id'];

    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    // Executa a consulta no banco
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $usuario['password'] == $senha) {
        $_SESSION = array();
        session_destroy();
    }
}

// Função para Editar os dados do Usuário
function atualizar_user($conexao, $id, $email, $senha, $nome, $nascimento)
{
    $sql = "UPDATE users SET email = :email, password = :password, nome = :nome, nascimento = :nascimento WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);

        // Os nomes dos marcadores são fixos e iguais aos do SQL
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $senha);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":nascimento", $nascimento);

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}


// Função para sair da sessão e apagar conta
function delete_user($conexao, $senha)
{
    // Id do usuário logado, guardado na sessão durante o login
    $id = $_SESSION['id'];

    // Busca a senha do usuário para conferir antes de apagar
    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    // Só continua se o usuário existir e a senha digitada for igual à do banco
    if ($usuario && $usuario['password'] == $senha) {
        try {
            // Apaga o usuário do banco (tem que ser ANTES de destruir a sessão)
            $stmt = $conexao->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            // Depois de apagar, encerra a sessão
            $_SESSION = array();
            session_destroy();
            return true;   // conta apagada e sessão encerrada
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;  // falhou ao apagar, a sessão continua ativa
        }
    }
    else{ echo "Senha Incorreta";}
}
