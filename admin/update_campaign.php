<?php 
require_once '../includes/functions.php';
require_once 'verify_adm.php';

// Verifica se o ID foi informado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../pages/campaigns.php");
    exit();
}

$id_campanha = $_GET['id'];

// Busca os dados da campanha no banco para preencher o formulário
$stmt = $conexao->prepare("SELECT * FROM campanhas WHERE id = :id");
$stmt->bindParam(":id", $id_campanha);
$stmt->execute();
$campanha = $stmt->fetch(PDO::FETCH_ASSOC);

// Se a campanha não existir, redireciona de volta
if (!$campanha) {
    header("Location: ../pages/campaigns.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Campanha</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<?php include '../includes/header.php'; ?>

<body>
    <main>
        <h1>Editar Campanha</h1>
        <form action="" method="post">
            <!-- Campo oculto para enviar o ID da campanha -->
            <input type="hidden" name="id" value="<?php echo $campanha['id']; ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($campanha['titulo']); ?>" placeholder="Insira um Título" required><br>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($campanha['descricao']); ?>" placeholder="Insira uma Descrição" required><br>
            <label for="url">Url da Imagem:</label>
            <input type="text" name="url" id="url" value="<?php echo htmlspecialchars($campanha['url_imagem']); ?>" placeholder="URL da sua Imagem" required><br>
            <input type="reset" value="Cancelar">
            <input type="submit" value="Salvar Alterações">
            
        </form>
        <?php campanhas($conexao); ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $url = $_POST['url'];
            $id = $_POST['id'];

            // Chama a função de atualização passando o ID e os novos dados
            if (atualizar_camp($conexao, $id, $titulo, $descricao, $url)) {
                header("Location: ../pages/campaigns.php");
                exit();
            } else {
                echo "<p style='color: red;'>Não foi possível atualizar a Campanha.</p>";
            }
        }
        ?>
    </main>
</body>

<?php include '../includes/footer.php'; ?>

</html>