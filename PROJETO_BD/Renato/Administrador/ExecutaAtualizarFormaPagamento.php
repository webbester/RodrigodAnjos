<?php

session_start();

include 'bd.php';

#region variaveis do usuario
$Id_formapagamento = $_POST['id_formapagamento'];
$formapagamento = $_POST['formapagamento'];
$IdUsuarioLogado = 1;
#endregion

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL AtualizarFormaPagamento(?,?,?)");

    $stmt->bindParam(
        1,
        $formapagamento,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $Id_formapagamento,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        3,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadFormadePagamento.php");

}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
?>