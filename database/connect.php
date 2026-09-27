<?php
$host = "";
$dbname = "";
$user = "";
$pass = "";

try {
    $conexao = new PDO ( // PDO = PHP Data Objects
        "pgsql:host=$host;
        dbname=$dbname",
        $user,
        $pass
    );
    echo "conexão realizada com sucesso! <br>";
    return $conexao;
} catch (PDOException $e){
    echo "erro: " . $e->getMessage();
}
?>