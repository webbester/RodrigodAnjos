<?php
	
	session_start();
	
	include  'bd.php';

	#region ABRE SESSION
	if(!isset($_SESSION['login'])){
		if (isset($_POST["user"])){
			if (isset($_POST["password"])){
				$_SESSION['user'] = $_POST["user"];
				$_SESSION['password'] = $_POST["password"];
				$_SESSION['id_usuario'] = 0;
			}
		}
	}
	
	#endregion
	
	#region variaveis do usuario
	$login = isset($_SESSION['user']) ? addslashes(trim($_SESSION['user'])) : FALSE;
	$senha = isset($_SESSION['password']) ? (trim($_SESSION['password'])) : FALSE;
	
	// $login = isset($_POST["user"]) ? addslashes(trim($_POST["user"])) : FALSE;
	// $senha = isset($_POST["password"]) ? (trim($_POST["password"])) : FALSE;
	$loginBanco = $login;
	#endregion
	
	#region conexão com banco
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		
		$stmt=$conn->prepare("CALL VerificaLoginESenha(?)");
		
		$stmt->bindParam(
			1,
				$loginBanco,
				PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
		
		//Executa SP
		$stmt->execute();
		
		$linha=$stmt->fetch();
		
		// if (count($linha) <= 0){
			// header("location:login.php?identifier=false");
			// exit;
		// } else if(password_verify($senha, $linha[1])){ //if($senha == $linha[1]){ // <- Para verificar senha sem hash
			// if ($login == "root"){
				// header ("location:index_A.php");
				// exit;
			// } else {
				// header ("location:index.php");
				// exit;
			// }
		// } else {
			// header("location:login.php?identifier=false");
			// exit;
		// }
		
		print_r($linha);
		echo "<br><br>";
		$_SESSION['id_usuario'] = ($linha[2]);
		echo $_SESSION['id_usuario'];
	} 
	
	catch (PDOException $e) { 
		$error = $e->getMessage(); 
		echo $error;
	}
	
	#endregion
	
?>