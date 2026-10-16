<?php require_once '../includes/functions.php';
require_once 'verify_user.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<?php include '../includes/header.php'; ?>


<body>
    <main>
        <h1>Edite as suas Informações</h1>
        <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Insira o E-mail" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Insira a senha" required><br>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Insira o seu Nome" required><br>
            <label for="nascimento">Nascimento:</label>
            <input type="date" name="nascimento" id="nascimento" placeholder="Insira a data do seu Nascimento" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Editar">
        </form>
        <!--Chama o Php e executa a função abaixo caso o metodo requisitado pela página seja o post-->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (atualizar_user($conexao, $_SESSION['id'], $_POST['email'], $_POST['senha'], $_POST['nome'], $_POST['nascimento'])) {
                echo "Usuário atualizado com sucesso!";
                header("Location: /cuide_dequem_cuidou/index.php");
                exit();
            }
            else{
                echo "A mudança não pode ser concluida no momento";
            }
        }
        ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>