<?php
	session_start();
?>
<html>
	<head>
		<title> Gerenciador de Contas </title>
        <link href="../Style.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<h1 align="center"> Gerenciador de Contas </h1>
			<table align="center" cellspacing="8" cellpadding="8">
				<tr><td>
					<fieldset style="padding: 50px">
						<form method="post" action="validaLogin.php">
							<table align="center">
								<tr><td colspan="2" align=center><font color="blue"><?php if(isset($_GET['Cadastro']) && $_GET['Cadastro'] == 'true')
																echo 'Cadastro realizado com sucesso. <br>Por favor, entre com seu login/senha';?></font></td></tr>
								<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['identifier']) && $_GET['identifier'] == 'false')
																echo 'Usuário e/ou Senha inválidos';?></font></td></tr>
								<tr>
									<td style="font-size: 24px; font-weight:bold; padding: 5px">Usuario: </td>
									<td><input  class="input" type="text" name="user" required autofocus></td>
								</tr>
								<tr>
									<td style="font-size: 24px; font-weight:bold; padding: 5px">Senha: </td>
									<td><input class="input" type="password" name="password" required></td>
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
									<td style="padding-left: 100px"><input type="submit" name="cadastrar" value="Sou Novo na Área"></td>
								</tr>
							</table>
						</form>
					</fieldset>
				</td></tr>
			</table>
	</body>
</html>