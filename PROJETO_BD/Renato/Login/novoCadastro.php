<?php
	session_start();
?>
<html>
	<head>
		<title> Cadastrar Novo Usuário </title>
        <link href="../Style.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<table align="center">
			<tr><td>
				<fieldset style="padding: 50px">
					<legend style="font-size: 24px; font-weight:bold; padding: 5px"> Novo Cadastro </legend>
					<form method="post" action="verificaSenha.php">
						<table align="center">
							<tr>
								<td style="font-size: 24px; font-weight:bold; padding: 5px">Nome Completo: </td>
								<td><input class="input" type="text" name="nomeUsuario" required autofocus></td>
							</tr>
							<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['login']) && $_GET['login'] == 'ja-existe')
															echo 'Nome de usuário já existe. Por favor, escolha outro!';?></font></td></tr>
							<tr>
								<td style="font-size: 24px; font-weight:bold; padding: 5px">Nome de Usuário: </td>
								<td><input class="input" type="text" name="username" required></td>
							</tr>
							<tr>
								<td style="font-size: 24px; font-weight:bold; padding: 5px">Senha: </td>
								<td><input class="input" type="password" name="pass" required></td>
							</tr>
							<tr>
								<td style="font-size: 24px; font-weight:bold; padding: 5px">Confirme sua Senha: </td>
								<td><input class="input" type="password" name="confirmacaopass" required></td>
								
							</tr>
							<tr><td colspan="2" align=center><font color="red"><?php if(isset($_GET['erroPass']) && $_GET['erroPass'] == 'false')
															echo 'Senhas não conferem. Por favor, redigite';?></font></td></tr>
							<tr></tr>
							<tr></tr>
							<tr>
								<td align="center">  <input type="submit" name="cadastrar" value="CADASTRAR">  </td>
                                <td><a href="login.php" class="Voltar">VOLTAR</a></td>
                            <tr>
						</table>
					</form>
				</fieldset>
			</td></tr>
		</table>
	</body>
</html>


















