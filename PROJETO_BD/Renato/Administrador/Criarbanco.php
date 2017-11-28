<?php

    session_start();

    include 'bd.php';

    #region variaveis do usuario
    $NomeBanco = $_POST['nomebanco'];
    $IdUsuarioLogado = 1;

    #endregion

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("CALL Criarbanco(?,?)");

        $stmt->bindParam(
            1,
            $NomeBanco,
            PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);

        $stmt->bindParam(
            2,
            $IdUsuarioLogado,
            PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);


        //executa a SP
        $stmt->execute();

        header("location:ReadBanco.php");
    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }
?>