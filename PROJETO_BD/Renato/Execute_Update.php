<?php
include 'banco_de_dados.php';
$Id_Transacao_Update = $_POST['Id_Transacao'];
$Nome_Usuario_Update = $_POST['Nome_Usuario'];

$Tipo_Transacao_Update = isset($_POST['Tipo_Transacao']) ? $_POST['Tipo_Transacao']: '';
$Banco_Origem_Update = isset($_POST['Banco_Origem']) ? $_POST['Banco_Origem']: '';
$Banco_Destino_Update = isset($_POST['Banco_Destino']) ? $_POST['Banco_Destino']: '';
$Formas_Pagamento_Update = isset($_POST['Formas_Pagamento']) ? $_POST['Formas_Pagamento']: '';
$Tipo_Moeda_Update = isset($_POST['Tipo_Moeda']) ? $_POST['Tipo_Moeda']: '';
$Valor_Update = isset($_POST['Valor']) ? $_POST['Valor']: '';
$Data_Update = isset($_POST['Data']) ? $_POST['Data']: '';
$Descricao_Update = isset($_POST['Descricao']) ? $_POST['Descricao']: '';

try{
    $stmt = $conn->prepare("CALL Update_Transacao(?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
    $stmt->bindParam(1, $Id_Transacao_Update, PDO::PARAM_STR);
    $stmt->bindParam(2, $Nome_Usuario_Update, PDO::PARAM_STR);
    $stmt->bindParam(3, $Tipo_Transacao_Update, PDO::PARAM_STR);
    $stmt->bindParam(4, $Banco_Origem_Update, PDO::PARAM_STR);
    $stmt->bindParam(5, $Banco_Destino_Update, PDO::PARAM_STR);
    $stmt->bindParam(6, $Formas_Pagamento_Update, PDO::PARAM_STR);
    $stmt->bindParam(7, $Tipo_Moeda_Update, PDO::PARAM_STR);
    $stmt->bindParam(8, $Valor_Update, PDO::PARAM_STR);
    $stmt->bindParam(9, $Data_Update, PDO::PARAM_STR);
    $stmt->bindParam(10, $Descricao_Update, PDO::PARAM_STR);
    $stmt->execute();

    header("location:Read_Trasancao.php");
}catch(PDOException $e){
    echo "Erro ao fazer o update";
}
?>
