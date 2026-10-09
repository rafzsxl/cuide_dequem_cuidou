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
function login_user($conexao, $email)
{
    $sql = "SELECT id, email, password, admin FROM users WHERE email = :email";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    } else {
        echo "Senha Incorreta";
    }
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

    // Senha errada: para aqui
    if (!$usuario || $usuario['password'] != $senha) {
        echo "Senha Inválida";
        return false;
    }

    // Já é voluntário: não cadastra de novo
    if (id_volun($conexao, $id)) {
        echo "Você já é voluntário.";
        return false;
    }

    try {
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
function relatorio_volun($conexao)
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

// Função para apagar voluntario
function apagar_volun($conexao, $id)
{
    $sql = "DELETE FROM voluntarios WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo "Voluntário de ID = $id Removido com sucesso";
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
}

// Retorna o id do voluntário ligado ao usuário, ou false se não for voluntário
function id_volun($conexao, $user_id)
{
    $stmt = $conexao->prepare("SELECT id FROM voluntarios WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $volun = $stmt->fetch(PDO::FETCH_ASSOC);

    return $volun ? $volun['id'] : false;
}

// Funções de doações
function relatorio_doacoes($conexao)
{
    $sql = "SELECT d.id AS id_doacao, d.valor, d.data,
               v.id AS id_volun, v.cpf, v.telefone,
               u.id AS id_user, u.nome, u.email
        FROM doacoes d
        INNER JOIN voluntarios v ON d.id_volun = v.id
        INNER JOIN users u ON v.user_id = u.id
        ORDER BY d.id";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $voluntarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($voluntarios as $voluntario) {
            echo "ID Voluntário: {$voluntario['id_volun']}<br>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Registra uma doação do usuário logado (que precisa ser voluntário)
function doar($conexao, $valor, $senha)
{
    $id = $_SESSION['id'];

    // Confere a senha do usuário logado
    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || $usuario['password'] != $senha) {
        echo "Senha Inválida";
        return false;   // para aqui
    }

    // Converte o id do usuário no id do voluntário
    $volun_id = id_volun($conexao, $id);
    if (!$volun_id) {
        return false;   // não é voluntário
    }

    try {
        $sql = "INSERT INTO doacoes (id_volun, valor, data)
                VALUES (:id_volun, :valor, NOW())";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_volun", $volun_id);
        $stmt->bindParam(":valor", $valor);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

// Funções de ADM

// Cria uma campanha em nome do admin
function criar_camp($conexao, $titulo, $descricao, $url)
{
    $id = $_SESSION['id'];

    try {
        // Ajuste os nomes das colunas se o banco usar outros (ex: url_imagem)
        $sql = "INSERT INTO campanhas (user_id, titulo, descricao, url_imagem, data_criacao)
                VALUES (:user_id, :titulo, :descricao, :url, NOW())";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":url", $url);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

// Função para apagar Campanha
function apagar_camp($conexao, $id)
{
    $sql = "DELETE FROM campanhas WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo "Campanha de ID = $id Removido com sucesso";
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
}