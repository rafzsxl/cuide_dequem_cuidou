<?php
require_once '../database/connect.php';

// Funçoes de Autenticação

// Fução para Criar Usuário
function criar_user($conexao, $email, $senha, $nome, $nascimento, $admin = false)
{
    $sql = "INSERT INTO users (email, password, nome, nascimento, admin) VALUES (:email, :senha, :nome , :nascimento, :admin)";
    try {
        // $stmt representa um objeto de instrução preparada
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



// Funções de Voluntarios
// Cadastra o usuário logado como voluntário, depois de conferir a senha
function criar_volun($conexao, $cpf, $telefone, $senha)
{
    $id = $_SESSION['id'];

    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Senha errada: para aqui e avisa quem chamou
    if (!$usuario || $usuario['password'] != $senha) {
        return false;
    }

    try {
        // Ajuste "id_user" para o nome real da coluna no seu banco
        $sql = "INSERT INTO voluntarios (user_id, cpf, telefone, data_volun)
                VALUES (:user_id, :cpf, :telefone, NOW())";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

// Função para demonstrar todos os Voluntários com INNER JOIN
// Função para demonstrar todos os Voluntários com INNER JOIN (sem a senha)
function relatorio($conexao)
{
    // Lista só as colunas desejadas; "password" fica de fora
    // "AS" dá nomes diferentes aos dois ids para não sobrescrever um ao outro
    $sql = "SELECT a.id AS id_volun, a.cpf, a.telefone, a.data_volun,
                   b.id AS id_user, b.nome, b.email, b.nascimento
            FROM voluntarios a
            INNER JOIN users b ON a.user_id = b.id
            ORDER BY a.id";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $voluntarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($voluntarios as $voluntario) {
            echo "ID Voluntário: {$voluntario['id_volun']}<br>";
            echo "ID Usuário: {$voluntario['id_user']}<br>";
            echo "Nome: {$voluntario['nome']}<br>";
            echo "E-mail: {$voluntario['email']}<br>";
            echo "Nascimento: {$voluntario['nascimento']}<br>";
            echo "CPF: {$voluntario['cpf']}<br>";
            echo "Telefone: {$voluntario['telefone']}<br>";
            echo "Data: {$voluntario['data_volun']}<br><br>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}