<?php require_once '../includes/functions.php';
require_once 'verify_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Campanha</title>
</head>

<?php include '../includes/header.php'; ?>



<body>
    <main>
        <h1>Crie Uma Campanha</h1>
        <form action="" method="post">
            <label for="titulo">TÍtulo:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Insira um TÍtulo" required><br>
            <label type="text">Descrição:</label>
            <input type="text" name="descricao" id="descricao" placeholder="Insira uma Descrição" required><br>
            <label type="text">Url da Imagem:</label>
            <input type="text" name="url" id="url" placeholder="URL da sua Imagem" required><br>
            <input type="reset" value="Limpar">
            <input type="submit" value="Criar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (criar_camp($conexao, $_POST['titulo'], $_POST['descricao'], $_POST['url'])) {
                header("Location: ../pages/campaigns.php");
                exit();
            }
            $erro = "Não foi Possivel criar a Campanha.";
        }
        ?>
    </main>
</body>


<?php include '../includes/footer.php'; ?>

</html>