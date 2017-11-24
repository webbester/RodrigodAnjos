<?php

	session_start();
	
	#region abre Sessão	
	if(!isset($_SESSION['cadastro'])){
		if(isset($_POST["nomeUsuario"])){
			if (isset($_POST["username"])) {
				if (isset($_POST["pass"])) {
					if (isset($_POST["confirmacaopass"])){
						$_SESSION['nomeUsuario'] = $_POST["nomeUsuario"];
						$_SESSION['username'] = $_POST["username"];
						$_SESSION['pass'] = $_POST["pass"];
						$_SESSION['confirmacaopass'] = $_POST["confirmacaopass"];
					}
				}
			}
		}
	}
	#endregion
	
	$_SESSION['senha1'] = isset($_SESSION['pass']) ? (trim($_SESSION['pass'])) : FALSE;
	$_SESSION['senha2'] = isset($_SESSION['confirmacaopass']) ? (trim($_SESSION['confirmacaopass'])) : FALSE;
		
	if ($_SESSION['senha1'] != $_SESSION['senha2'])
	{
		header('location:novoCadastro.php?erroPass=false');
		exit;
	} else {
		header('location:validaCadastro.php');
		// header('location:validaCadastro.php?Cadastro=true');
		exit;
	}
?>