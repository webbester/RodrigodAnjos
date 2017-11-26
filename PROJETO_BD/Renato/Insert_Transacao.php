	<?php
    session_start();
    if(!isset($_SESSION['user']))
        header("location: /Estudo Dirigido Banco de Dados/Login/Login.php");
    require 'banco_de_dados.php';

		$Id_Usuario = isset($_SESSION['id_user']) ? $_SESSION['id_user']: NULL;
		$Tipo_Transacao = isset($_POST['Tipo_Transacao']) ? $_POST['Tipo_Transacao']: NULL;
		$Banco_Origem = isset($_POST['Banco_Origem']) ? $_POST['Banco_Origem']: NULL;
		$Banco_Destino = isset($_POST['Banco_Destino']) ? $_POST['Banco_Destino']: NULL;
		$Forma_Pagamento = isset($_POST['Forma_Pagamento']) ? $_POST['Forma_Pagamento']: NULL;
		$Moeda = isset($_POST['Moeda']) ? $_POST['Moeda']: NULL;
		$Valor = isset($_POST['Valor']) ? $_POST['Valor']: NULL;
		$Data = isset($_POST['Data']) ? $_POST['Data']: NULL;
        $Descricao = isset($_POST['Descricao']) ? $_POST['Descricao']: NULL;

		echo $Nome_Usuario .'</br>';
		echo $Tipo_Transacao .'</br>';
		echo $Banco_Origem .'</br>';
		echo $Banco_Destino .'</br>';
		echo $Forma_Pagamento .'</br>';
		echo $Moeda .'</br>';
		echo $Valor .'</br>';
		echo $Data .'</br>';
        echo $Descricao;

		//try {
            $stmt = $conn->prepare("CALL Insert_Transacao(?, ?, ?, ?, ?, ?, ?, ?, ? )");
            $stmt->bindParam(1, $Id_Usuario, PDO::PARAM_INT);
            $stmt->bindParam(2, $Tipo_Transacao, PDO::PARAM_INT);
            if ($Banco_Origem == NULL) {
                $stmt->bindValue(3, NULL,PDO::PARAM_INT);
            } else {
                $stmt->bindParam(3, $Banco_Origem, PDO::PARAM_INT);
            }
            if ($Banco_Destino == NULL) {
                $stmt->bindValue(4, NULL, PDO::PARAM_INT);
            } else {
                $stmt->bindParam(4, $Banco_Destino, PDO::PARAM_INT);
            }
            $stmt->bindParam(5, $Forma_Pagamento, PDO::PARAM_INT);
            $stmt->bindParam(6, $Moeda, PDO::PARAM_INT);
            $stmt->bindParam(7, $Valor, PDO::PARAM_INT);
            $stmt->bindParam(8, $Data, PDO::PARAM_STR);
            if ($Descricao == NULL) {
                $stmt->bindValue(9, NULL,PDO::PARAM_INT);
            } else {
                $stmt->bindParam(9, $Descricao, PDO::PARAM_STR);
            }
            $stmt->execute();

            header("location:Index.php");
        //}catch(PDOException $e){
		//	echo "Erro ao fazer o insert";
		//}
	?>