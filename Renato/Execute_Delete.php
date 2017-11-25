<?php
include 'banco_de_dados.php';

$id_trans = $_GET['id_transacao'];
$id_usuario = $_GET['usr_id'];

try{
    $stmt = $conn->prepare("CALL Delete_Transacao(?, ? )");
    $stmt->bindParam(1, $id_trans, PDO::PARAM_STR);
    $stmt->bindParam(2, $id_usuario, PDO::PARAM_STR);
    $stmt->execute();

    header("location:Read_Trasancao.php");

}catch(PDOException $e){
    echo "Erro ao fazer o delete";
}
?>
