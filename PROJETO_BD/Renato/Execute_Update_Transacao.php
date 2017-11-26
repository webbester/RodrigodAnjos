<?php
session_start();
if(!isset($_SESSION['user']))
    header("location: /Estudo Dirigido Banco de Dados/Login/Login.php");
require 'banco_de_dados.php';

$Id_Transacao_Update = $_POST['id_transacao'];
$id_usuario = isset($_SESSION['id_user'])? $_SESSION['id_user']: NULL;

$Tipo_Transacao_Update = isset($_POST['Tipo_Transacao']) ? $_POST['Tipo_Transacao']: '';
$Banco_Origem_Update = isset($_POST['Banco_Origem']) ? $_POST['Banco_Origem']: '';
$Banco_Destino_Update = isset($_POST['Banco_Destino']) ? $_POST['Banco_Destino']: '';
$Formas_Pagamento_Update = isset($_POST['Forma_Pagamento']) ? $_POST['Forma_Pagamento']: '';
$Tipo_Moeda_Update = isset($_POST['Moeda']) ? $_POST['Moeda']: '';
$Valor_Update = isset($_POST['Valor']) ? $_POST['Valor']: '';
$Data_Update = isset($_POST['Data']) ? $_POST['Data']: '';
$Descricao_Update = isset($_POST['Descricao']) ? $_POST['Descricao']: '';

try{
    $stmt = $conn->prepare("CALL Update_Transacao(?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
    $stmt->bindParam(1, $Id_Transacao_Update, PDO::PARAM_STR);
    $stmt->bindParam(2, $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(3, $Tipo_Transacao_Update, PDO::PARAM_INT);

    if($Banco_Origem_Update <> "null") {
        echo "entrou ori";
        $stmt->bindParam(4, $Banco_Origem_Update, PDO::PARAM_STR);
    }else{
        $stmt->bindValue(4, NULL, PDO::PARAM_NULL);
    }
    if($Banco_Destino_Update <> "null") {
        echo "entrou dest";
        $stmt->bindParam(5, $Banco_Destino_Update, PDO::PARAM_STR);
    }else{
        $stmt->bindValue(5, NULL, PDO::PARAM_NULL);
    }

    $stmt->bindParam(6, $Formas_Pagamento_Update, PDO::PARAM_INT);
    $stmt->bindParam(7, $Tipo_Moeda_Update, PDO::PARAM_INT);
    $stmt->bindParam(8, $Valor_Update, PDO::PARAM_STR);
    $stmt->bindParam(9, $Data_Update, PDO::PARAM_STR);
    if($Descricao_Update <> "null") {
        $stmt->bindParam(10, $Descricao_Update, PDO::PARAM_STR);
    }else{
        $stmt->bindValue(10, NULL, PDO::PARAM_NULL);
    }$stmt->execute();

    header("location:Index.php");
}catch(PDOException $e){
    echo "Erro ao fazer o update";
}
?>
