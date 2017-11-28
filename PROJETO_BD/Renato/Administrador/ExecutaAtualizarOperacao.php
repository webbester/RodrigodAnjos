<?php

session_start();

include 'bd.php';

#region variaveis do usuario
$Id_operacao = $_POST['id_operacao'];
$operacao = $_POST['operacao'];
$IdUsuarioLogado = 1;
#endregion

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL AtualizarOperacao(?,?,?)");

    $stmt->bindParam(
        1,
        $operacao,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $Id_operacao,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        3,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadOperacao.php");

}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
?>