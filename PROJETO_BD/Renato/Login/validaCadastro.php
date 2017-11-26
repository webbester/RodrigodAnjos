<?php
	
	session_start();

	require 'bd.php';
	
	#region variaveis do usuario
		
	$nomeUsuario = isset($_SESSION['nomeUsuario']) ? addslashes(trim($_SESSION['nomeUsuario'])) : FALSE;
	$login = isset($_SESSION['username']) ? addslashes(trim($_SESSION['username'])) : FALSE;
	$senha = isset($_SESSION['pass']) ? (trim($_SESSION['pass'])) : FALSE;
	$senha = password_hash($senha, PASSWORD_DEFAULT);
	#endregion
	
	#region conexão com banco para CADASTRO
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		
		$stmt=$conn->prepare("CALL CriarUsuario(?,?,?)");
		
		$stmt->bindParam(
			1,
				$nomeUsuario,
				PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
		
		$stmt->bindParam(
			2,
				$login,
				PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
		
		$stmt->bindParam(
			3,
				$senha,
				PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
				
		//executa a SP
		$stmt->execute();
		
		$result=$stmt->fetch();
		print_r ($result[0])."<br>";
		
		if($result[0] == "Login existente, por favor escolha outro!"){
			header("location:novoCadastro.php?login=ja-existe");
			exit;
		} else if($result[0] == "Cadastro concluído com sucesso!"){
			header("location:login.php?Cadastro=true");
			exit;
		}
		
		
	}	
	catch (PDOException $e) { 
		$error = $e->getMessage(); 
		echo $error;
	}
	#endregion 

?>