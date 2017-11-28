<?php

session_start();

include 'bd.php';

#region variaveis do usuario
$FormaPagamento = $_POST['formapagamento'];
$IdUsuarioLogado = 1;
#endregion

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL CriarFormaPagamento(?,?)");

    $stmt->bindParam(
        1,
        $FormaPagamento,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadFormadepagamento.php");
}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
?>