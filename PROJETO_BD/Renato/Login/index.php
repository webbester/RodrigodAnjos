<?php
	session_start();
?>
<html>
	<head>
		<title>Início</title>
	</head>
	<body>
		<h1 style="text-align:center;">SEJA BEM-VINDO <?php echo strtoupper($_SESSION['user']);?><br><br></h1>
		
		<?php
			if ($_SESSION['user'] == "root"){
			echo "<h3 style=\"text-align:center;\"> Você é Administrador </h3>";
			} else {
			echo "<h3 style=\"text-align:center;\"> Você é usuário comum </h3>";
			} 
		?>
			
		<table>
			<tr>
				<td><form align="center" method="post" action="login.php"><input type="submit" name="exit" value="SAIR"></form></td>
				<td></td>
				<td><form align="center" method="post" action="login.php"><input type="submit" name="exit" value="SAIR"></form></td>
			</tr>
		</table>
		
		<a href="../Read_Trasancao.php">Read transacao</a>
		<form align="center" method="post" action=""><input type="submit" name="exit" value="SAIR"></form>
    </body>
</html>

<?php

require '..\banco_de_dados.php';
$teste = 1;
$tps_tran = $conn->prepare("Call ReturnAllTipo_Transacao(?)");
$tps_tran->bindParam(1, $teste, PDO::PARAM_INT);
$tps_tran->execute();
$result = $tps_tran->fetchAll(PDO::FETCH_ASSOC);
print_r($result);

if(isset($_POST['exit'])) {
    session_destroy();
    header("location: login.php");
}
?>