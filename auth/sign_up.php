<?php 
require_once '../includes/functions.php'; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php include '../includes/header.php'; ?>
<body>
    <main>
        <h1>Crie sua Conta</h1>
        <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Insira o seu Nome" required><br>
            <label for="nascimento">Nascimento:</label>
            <input type="date" name="nascimento" id="nascimento" placeholder="Insira a data do seu Nascimento" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Criar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            // 1. Cria o usuário no banco
            criar_user($conexao, $_POST['email'], $_POST['senha'], $_POST['nome'], $_POST['nascimento'], false);  
            // 2. Busca o usuário recém-criado para logar
            $usuario = login_user($conexao, $_POST['email']);                      
            // 3. Compara a senha digitada diretamente com a do banco
            if ($usuario && $usuario['password'] == $_POST['senha']) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['email'] = $usuario['email'];              
                // Converte para true/false de verdade (o PostgreSQL pode devolver 't'/'f')
                $_SESSION['admin'] = in_array($usuario['admin'], [true, 't', 1, '1'], true);
                // Redireciona para a página inicial já logado
                header("Location: /cuide_dequem_cuidou/index.php");
                exit();
            } else {
                echo "<p style='color: red;'>Erro ao iniciar a sessão automaticamente.</p>";
            }      
        }
        ?>
    </main>
</body>
<?php include '../includes/footer.php'; ?>
</html>