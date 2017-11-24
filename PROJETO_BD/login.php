<?php
	session_start();
	session_destroy();
?>
<html>
	<head>
		<title> Gerenciador de Contas </title>
	</head>
	<body>
		<h1 align="center"> Gerenciador de Contas </h1>
			<table align="center">
				<tr><td>
					<fieldset>
						<form method="post" action="validaLogin.php">
							<table align="center">
								<tr><td colspan="2" align=center><font color="blue"><?php if(isset($_GET['Cadastro']) && $_GET['Cadastro'] == 'true')
																echo 'Cadastro realizado com sucesso. <br>Por favor, entre com seu login/senha';?></font></td></tr>
								<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['identifier']) && $_GET['identifier'] == 'false')
																echo 'Usuário e/ou Senha inválidos';?></font></td></tr>
								<tr>
									<td>Usuario: </td>
									<td><input type="text" name="user" required autofocus></td> 
								</tr>
								<tr>
									<td>Senha: </td>
									<td><input type="password" name="password" required></td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td></td>
									<td align="center"><input type="submit" name="enviar" value="Enviar"> | 
									<input type="reset" name="limpar" value="Limpar"></td>
								</tr>
							</table>
						</form>
						<form method="post" action="novoCadastro.php">
							<table align="center">
								<tr>
									<td></td>
									<td align="center"><input type="submit" name="cadastrar" value="Sou Novo na Área"></td>
								</tr>
							</table>
						</form>
					</fieldset>
				</td></tr>
			</table>
	</body>
</html>