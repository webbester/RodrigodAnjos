<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estudo Dirigido Banco de Dados</title>
<?php include 'banco_de_dados.php' ?>
<?php //header("Content-type: text/html; charset=utf-8"); ?>

</head>
<body>
<form method="POST" name="formulario_transacao" action="Insert_Transacao.php">
	<table>
	<tr>
		<td>Nome Usúario</td>
		<td><input type="text" name="Nome_Usuario"></td>
		<td>Tipo Transação</td>
		<td>
			<select name="Tipo_Transacao">
		<option value=""></option>
		<?php 
			foreach($conn->query('select id,nome from tipo_transacao')as $row){
				 echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
			}
		?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Banco Origem</td>
		<td>
			<select name="Banco_Origem">
				<option value=""></option>
				<?php foreach($conn->query('select id,nome from banco')as $row){
					echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
				} ?>
			</select>
		</td>
		<td>Banco Destino</td>
		<td>
			<select name="Banco_Destino">
				<option value=""></option>
				<?php foreach($conn->query('select id,nome from banco')as $row){
					echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Forma de Pagamento</td>
		<td>
			<select name="Forma_Pagamento">
				<option value=""></option>
				<?php foreach($conn->query('select id,nome from forma_pagamento')as $row){
					echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
				} ?>
			</select>
		</td>
		<td>Moeda</td>
		<td>
			<select name="Moeda">
				<option value=""></option>
				<?php foreach($conn->query('select id,nome from tipo_moeda')as $row){
					echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Valor</td>
		<td><input type="number" name="Valor"</td>
		<td>Data</td>
		<td><input type="date" name="Data"</td>
        <tr>
            <td colspan="4">
                <textarea name="Descricao" rows="4" cols="90" ></textarea>
            </td>
        </tr>
	</tr>
	</table>
	<input type="submit" value="submit"></input>


    <br><br><br><hr><br><br><br>



</form>
</body>
</html>