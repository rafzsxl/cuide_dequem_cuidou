<?php
require_once __DIR__ . '/../database/connect.php';

// Função para verificar se o usuário é admin == true
function isAdmin()
{
    // Caso não tenha iniciado a sessão, a sessão é iniciada.
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Caso a Sessão já tenha sido iniciada, é verificado se o user da sessão é admin == true
    return !empty($_SESSION['admin']) && $_SESSION['admin'] === true;
}

// --- FUNÇÕES DE AUTENTICAÇÃO E USUÁRIOS ---

// Criar Usuário
function criar_user($conexao, $email, $senha, $nome, $nascimento, $admin = false)
{
    // Consulta ao Banco e Prepara para inserir valores
    $sql = "INSERT INTO users (email, password, nome, nascimento, admin) VALUES (:email, :senha, :nome, :nascimento, :admin)";
    // Tudo o que está dentro de try será executado e ser der erro o catch nos informará
    try {
        // Prepara a query SQL no banco antes de enviar os dadps reais
        $stmt = $conexao->prepare($sql);
        // Vinculação de Parametros(bind)
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":nascimento", $nascimento);
        $stmt->bindValue(":admin", $admin, PDO::PARAM_BOOL);
        //Executo e caso de certo imprime mensagem
        $stmt->execute();
        echo "Usuário Criado com Sucesso";
        //Caso de Errado ele mostrará o que ocorreu3
    } catch (PDOException $e) {
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
    }
}

// Função de Logout
function logout_user()
{
    // Limpa todos os Dados armazenados na sessão
    $_SESSION = array();
    // Destroi todos eles.
    session_destroy();
}

// Função de Atualizar Usuário
function atualizar_user($conexao, $id, $email, $senha, $nome, $nascimento)
{
    $sql = "UPDATE users SET email = :email, password = :password, nome = :nome, nascimento = :nascimento WHERE id = :id";
    try {
        // Prepara a query SQL no banco antes de enviar os dados reais
        $stmt = $conexao->prepare($sql);
        // Vinculação de Parametros(bind)
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $senha);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":nascimento", $nascimento);

        $stmt->execute();
    } catch (PDOException $e) {
    }
}

// Função para deletar Usuário
function delete_user($conexao, $senha)
{
    $id = $_SESSION['id']; // ID do Usuário logado
    // 1. Confere se o usuário existe e se a senha está correta
    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario || $usuario['password'] != $senha) {
        echo "Senha Incorreta";
        return false;
    }
    try {
        // Inicia a transação para segurança do banco de dados
        $conexao->beginTransaction();
        // 2. Verifica se o usuário possui cadastro como voluntário
        $stmtVolun = $conexao->prepare("SELECT id FROM voluntarios WHERE user_id = :id");
        $stmtVolun->bindParam(":id", $id);
        $stmtVolun->execute();
        $voluntario = $stmtVolun->fetch(PDO::FETCH_ASSOC); // <--- Corrigido aqui
        if ($voluntario) {
            $volun_id = $voluntario['id'];
            // 3. Apaga as doações vinculadas a esse voluntário
            $stmtDoacoes = $conexao->prepare("DELETE FROM doacoes WHERE id_volun = :volun_id");
            $stmtDoacoes->bindParam(":volun_id", $volun_id);
            $stmtDoacoes->execute();
            // 4. Apaga o registro de voluntário
            $stmtDelVolun = $conexao->prepare("DELETE FROM voluntarios WHERE id = :volun_id");
            $stmtDelVolun->bindParam(":volun_id", $volun_id);
            $stmtDelVolun->execute();
        }
        // 5. Por fim, apaga o usuário da tabela 'users'
        $stmtUser = $conexao->prepare("DELETE FROM users WHERE id = :id");
        $stmtUser->bindParam(":id", $id);
        $stmtUser->execute();
        // Confirma todas as exclusões no banco
        $conexao->commit();
        // Encerra a sessão
        $_SESSION = array();
        session_destroy();
        return true;
    } catch (PDOException $e) {
        // Se ocorrer qualquer erro, desfaz todas as alterações
        $conexao->rollBack();
        return false;
    }
}

// --- FUNÇÕES DE VOLUNTÁRIOS ---

// Função para criar voluntário
function criar_volun($conexao, $cpf, $telefone, $senha)
{
    $id = $_SESSION['id'];

    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || $usuario['password'] != $senha) {
        echo "Senha Inválida";
        return false;
    }

    if (id_volun($conexao, $id)) {
        echo "Você já é voluntário.";
        return false;
    }

    try {
        $sql = "INSERT INTO voluntarios (user_id, cpf, telefone, data_volun) VALUES (:user_id, :cpf, :telefone, NOW())";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Função para visualizar todos os voluntários com INNER JOIN
function relatorio_volun($conexao)
{
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
            $data = date('H:i - d/m/Y', strtotime($voluntario['data_volun']));
            echo "ID Voluntário: {$voluntario['id_volun']}<br>";
            echo "ID Usuário: {$voluntario['id_user']}<br>";
            echo "Nome: {$voluntario['nome']}<br>";
            echo "E-mail: {$voluntario['email']}<br>";
            echo "Nascimento: {$voluntario['nascimento']}<br>";
            echo "CPF: {$voluntario['cpf']}<br>";
            echo "Telefone: {$voluntario['telefone']}<br>";
            echo "Voluntário desde: {$data}<br><hr>";
        }
    } catch (PDOException $e) {
    }
}

// Função para apagar voluntário
function apagar_volun($conexao, $id)
{
    try {
        // Inicia uma transação para garantir que ambas as exclusões ocorram com sucesso
        $conexao->beginTransaction();

        // 1. Apaga as doações associadas a este voluntário primeiro
        $stmtDoacoes = $conexao->prepare("DELETE FROM doacoes WHERE id_volun = :id");
        $stmtDoacoes->bindParam(":id", $id);
        $stmtDoacoes->execute();

        // 2. Agora apaga o voluntário sem violar a restrição de chave estrangeira
        $stmtVolun = $conexao->prepare("DELETE FROM voluntarios WHERE id = :id");
        $stmtVolun->bindParam(":id", $id);
        $stmtVolun->execute();

        // Confirma as alterações no banco
        $conexao->commit();
        echo "Voluntário de ID = $id e suas doações associadas foram removidos com sucesso.";
    } catch (PDOException $e) {
        // Se algo der errado, reverte as alterações
        $conexao->rollBack();
    }
}

// Função para demonstrar o id de um usuário
function id_volun($conexao, $user_id)
{
    $stmt = $conexao->prepare("SELECT id FROM voluntarios WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $volun = $stmt->fetch(PDO::FETCH_ASSOC);

    return $volun ? $volun['id'] : false;
}


// --- FUNÇÕES DE DOAÇÕES ---

// Função para demonstrar todas as Doações
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
        $doacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Apenas um foreach para evitar duplicação dos registros na tela
        foreach ($doacoes as $item) {
            $valor_formatado = number_format($item['valor'], 2, ',', '.');
            $data_formatada = date('d/m/Y H:i', strtotime($item['data']));

            echo "<strong>Doação ID:</strong> {$item['id_doacao']}<br>";
            echo "<strong>Valor:</strong> R$ {$valor_formatado}<br>";
            echo "<strong>Data:</strong> {$data_formatada}<br>";
            echo "<strong>Voluntário ID:</strong> {$item['id_volun']}<br>";
            echo "<strong>CPF:</strong> {$item['cpf']}<br>";
            echo "<strong>Telefone:</strong> {$item['telefone']}<br>";
            echo "<strong>Usuário ID:</strong> {$item['id_user']}<br>";
            echo "<strong>Nome:</strong> {$item['nome']}<br>";
            echo "<strong>E-mail:</strong> {$item['email']}<br>";
            echo "<hr>";
        }
    } catch (PDOException $e) {
    }
}

// Função para realizar uma doação
function doar($conexao, $valor, $senha)
{
    $id = $_SESSION['id'];

    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || $usuario['password'] != $senha) {
        echo "Senha Inválida";
        return false;
    }

    $volun_id = id_volun($conexao, $id);
    if (!$volun_id) {
        return false;
    }

    try {
        $sql = "INSERT INTO doacoes (id_volun, valor, data) VALUES (:id_volun, :valor, NOW())";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_volun", $volun_id);
        $stmt->bindParam(":valor", $valor);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Função para calcular a soma de todas as doações, com formatação para R$
function total_doacoes($conexao)
{
    $sql = "SELECT SUM(valor) AS total FROM doacoes";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        $total = $resultado['total'] ?? 0;
        $total_formatado = number_format($total, 2, ',', '.');

        echo "<strong>R$ {$total_formatado}</strong>";
    } catch (PDOException $e) {
    }
}


// --- FUNÇÕES DE CAMPANHAS E ADMIN ---

// Funçãp para criar uma campanha
function criar_camp($conexao, $titulo, $descricao, $url)
{
    $id = $_SESSION['id'];

    try {
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
        return false;
    }
}

// Função para excluir uma campanha
function apagar_camp($conexao, $id)
{
    $sql = "DELETE FROM campanhas WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo "Campanha de ID = $id Removido com sucesso";
    } catch (PDOException $e) {
    }
}

// Função para visualizar todas as campanhas
function campanhas($conexao)
{
    $sql = "SELECT * FROM campanhas";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $campanhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($campanhas as $campanha) {
            $data = date('d/m/Y', strtotime($campanha['data_criacao']));

            if (isAdmin()) {
                echo "ID: {$campanha['id']}<br>";
            } else {
            }
            echo "<h2>{$campanha['titulo']}</h2><br>";
            echo "{$campanha['descricao']}<br>";
            echo "<img src='{$campanha['url_imagem']}' alt='{$campanha['titulo']}' width='300'><br>";
            echo "Realizada em: {$data}<br><hr>";
        }
    } catch (PDOException $e) {
    }
}

// Função para editar uma campanha 
function atualizar_camp($conexao, $id_campanha, $titulo, $descricao, $url)
{
    $sql = "UPDATE campanhas SET titulo = :titulo, descricao = :descricao, url_imagem = :url WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":id", $id_campanha);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":url", $url);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
