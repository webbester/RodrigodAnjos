<?php

session_start();

include 'bd.php';

#region variaveis do usuario
$Id_transacao = $_POST['id_transacao'];
$Nometransacao = $_POST['transacao'];
$IdUsuarioLogado = 1;
#endregion

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL AtualizarTipoTransacao(?,?,?)");

    $stmt->bindParam(
        1,
        $Nometransacao,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $Id_transacao,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        3,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadTipoTransacao.php");

}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
?>