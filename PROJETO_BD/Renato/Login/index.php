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
		
		
		<form align="center" method="post" action="login.php"><input type="submit" name="exit" value="SAIR"></form>
	</body>
</html>