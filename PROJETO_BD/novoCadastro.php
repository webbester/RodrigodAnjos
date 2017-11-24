<?php
	session_start();
?>
<html>
	<head>
		<title> Cadastrar Novo Usuário </title>
	</head>
	<body>
		<table align="center">
			<tr><td>
				<fieldset>
					<legend> Novo Cadastro </legend>
					<form method="post" action="verificaSenha.php">
						<table align="center">
							<tr>
								<td>Nome Completo: </td>
								<td><input type="text" name="nomeUsuario" required autofocus></td>
							</tr>
							<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['login']) && $_GET['login'] == 'ja-existe')
															echo 'Nome de usuário já existe. Por favor, escolha outro!';?></font></td></tr>
							<tr>
								<td>Nome de Usuário: </td>
								<td><input type="text" name="username" required></td>
							</tr>
							<tr>
								<td>Senha: </td>
								<td><input type="password" name="pass" required></td>
							</tr>
							<tr>
								<td>Confirme sua Senha: </td>
								<td><input type="password" name="confirmacaopass" required></td>
								
							</tr>
							<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['erroPass']) && $_GET['erroPass'] == 'false')
															echo 'Senhas não conferem. Por favor, redigite';?></font></td></tr>
							<tr></tr>
							<tr></tr>
							<tr>
								<td colspan="3" align="center"> | <input type="submit" name="cadastrar" value="CADASTRAR"> | </td><tr>
						</table>
					</form>
				
				</fieldset>
			</td></tr>
		</table>
	</body>
</html>


















