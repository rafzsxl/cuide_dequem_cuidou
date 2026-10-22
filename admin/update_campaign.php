<?php
require_once '../includes/functions.php';
require_once 'verify_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Campanha</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Editar Campanha</h1>

        <form action="" method="post">
            <label for="id">ID:</label>
            <input type="number" name="id" id="id" placeholder="Insira o ID para Editar" required><br>

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Insira um Título" required><br>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" placeholder="Insira uma Descrição" required><br>

            <label for="url">Url da Imagem:</label>
            <input type="text" name="url" id="url" placeholder="URL da sua Imagem" required><br>

            <input type="submit" value="Salvar Alterações">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $url = $_POST['url'];

            if (atualizar_camp($conexao, $id, $titulo, $descricao, $url)) {
                header("Location: /cuide_dequem_cuidou/pages/campaigns.php");
                exit();
            } else {
                $mensagem = "<p style='color: red;'>Não foi possível atualizar a Campanha.</p>";
            }
        }
        ?>
        <?php campanhas($conexao); ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>