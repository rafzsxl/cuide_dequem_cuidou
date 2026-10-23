<?php
$host = "127.0.0.1";
$dbname = "cdqc";
$user = "cdqc";
$pass = "cdqc123";
$port = "5432";

try {
    //$conexao faz a ponte ente o PHP) e o banco de dados PostgreSQL.
    $conexao = new PDO ( //PHP Data Objects Recebe os parametros de conexão e se estiver tudo correco retorna o echo abaixo 
        "pgsql:host=$host;
        dbname=$dbname",
        $user,
        $pass
    );
    //Caso de Certo imprime a Mensagem, Porém foi comentada para deixar o site mais bonito, pois aparecerá em todo o header devido a conexão do mesmo com o banco devido ao include functions.

    // echo "conexão realizada com sucesso! <br>";
    return $conexao;
    //Caso aconteça algum imprevisto o PHP captura esse erro sem quebrar o site inteiro e exibe amensagem de erro
} catch (PDOException $e){
    echo "erro: " . $e->getMessage();
}
?>