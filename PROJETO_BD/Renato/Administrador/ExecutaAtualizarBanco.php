<?php

session_start();
if(!isset($_SESSION['user']))
    header("location: /Estudo Dirigido Banco de Dados/Login/Login.php");
require '../banco_de_dados.php';

#region variaveis do usuario
$Id_banco = $_POST['id_banco'];
$NomeBanco = $_POST['nomebanco'];
$IdUsuarioLogado = $_SESSION['id_user'];

print_r($_SESSION);
#endregion

/*try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("CALL Atualizarbanco(?,?,?)");

    $stmt->bindParam(
        1,
        $NomeBanco,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        2,
        $Id_banco,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

    $stmt->bindParam(
        3,
        $IdUsuarioLogado,
        PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


    //executa a SP
    $stmt->execute();

    header("location:ReadBanco.php");

}
catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}*/
?>