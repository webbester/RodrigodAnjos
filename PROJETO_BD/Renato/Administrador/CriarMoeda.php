<?php

session_start();

include 'bd.php';

#region variaveis do usuario
$CriarMoeda = $_POST['criarmoeda'];
$IdUsuarioLogado = 1;
#endregion

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL CriarTipoMoeda(?,?)");

    $stmt->bindParam(
        1,
        $CriarMoeda,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadMoeda.php");
}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
?>