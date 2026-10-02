<?php
$host = "192.168.10.67";
$dbname = "cdqc";
$user = "cdqc";
$pass = "adm123";

try {
    $conexao = new PDO ( // PDO = PHP Data Objects
        "pgsql:host=$host;
        dbname=$dbname",
        $user,
        $pass
    );
    // echo "conexão realizada com sucesso! <br>";
    return $conexao;
} catch (PDOException $e){
    echo "erro: " . $e->getMessage();
}
?>