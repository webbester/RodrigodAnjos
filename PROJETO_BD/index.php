<?php include 'banco_de_dados.php' ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Relatórios das transações!</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

	</head>
	<?php 
		//$IdUsuario = $_SESSION['userId']; comentado apenas para testes
		$IdUsuario = 1;
		$IdTipoTransacao= "";
		$IdCategoria= "";
		$IdBancoOrigem= "";
		$IdBancoDestino= "";
		$IdFormaPagamento= "";
		$idTipoMoeda= "";
		$dataInicial= "6";
		$dataFinal= "";

		if (isset($_POST["Tipo_Transacao"])){
			$IdTipoTransacao = $_POST["Tipo_Transacao"];
		}
		if (isset($_POST["Categoria"])){
			$IdCategoria = $_POST["Categoria"];
		}
		if (isset($_POST["Banco_Origem"])){
			$IdBancoOrigem = $_POST["Banco_Origem"];
		}
		if (isset($_POST["Banco_Destino"])){
			$IdBancoDestino = $_POST["Banco_Destino"];
		}
		if (isset($_POST["Forma_Pagamento"])){
			$IdFormaPagamento = $_POST["Forma_Pagamento"];
		}
		if (isset($_POST["Moeda"])){
			$idTipoMoeda = $_POST["Moeda"];
		}
		if (isset($_POST["DataInicial"])){
			$dataInicial = $_POST["DataInicial"];			
		}
		if (isset($_POST["DataFinal"])){
			$dataFinal = $_POST["DataFinal"];
		}
		
	?>

	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">
						Relatório das suas transações realizadas.
					</h3>
					<div class="row">
						<form method="POST" name="formulario_filtros" action="index.php">
							<div class="col-md-8">
								<span class="label label-primary">Aplique os filtros abaixo e pressione o botão FILTRAR.</span>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">

											<label for="Tipo_Transacao">
												Tipo da transação
											</label>
											<select class="form-control" name="Tipo_Transacao">
												<option value=""></option>
												<?php 
													foreach($conn->query('select id,nome from tipo_transacao')as $row){
														 echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
													}
												?>
											</select>
										</div>
										<div class="form-group">

											<label for="Forma_Pagamento">
												Categoria
											</label>
											<select class="form-control" name="Categoria">
												<option value=""></option>
												<?php foreach($conn->query('select id,nome from categoria')as $row){
													echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
												} ?>
											</select>
										</div>
										<div class="form-group">

											<label for="Banco_Origem">
												Banco de origem
											</label>
											<select class="form-control" name="Banco_Origem">
												<option value=""></option>
												<?php foreach($conn->query('select id,nome from banco')as $row){
													echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
												} ?>
											</select>
										</div>
										<div class="form-group">

											<label for="Banco_Destino">
												Banco de destino
											</label>
											<select class="form-control" name="Banco_Destino">
												<option value=""></option>
												<?php foreach($conn->query('select id,nome from banco')as $row){
													echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
												} ?>
											</select>
										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="Moeda">
												Tipo da moeda
											</label>
											<select class="form-control" name="Moeda">
												<option value=""></option>
												<?php foreach($conn->query('select id,nome from tipo_moeda')as $row){
													echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
												} ?>
											</select>
										</div>
										<div class="form-group">

											<label for="Forma_Pagamento">
												Forma de pagamento
											</label>
											<select class="form-control" name="Forma_Pagamento">
												<option value=""></option>
												<?php foreach($conn->query('select id,nome from forma_pagamento')as $row){
													echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
												} ?>
											</select>
										</div>
										<div class="form-group">
											<label for="DataInicial">
												Data inicial
											</label>
											<input class="form-control"  type="datetime-local" name="DataInicial" </td>
										</div>
										<div class="form-group">
											<label for="DataFinal">
												Data final
											</label>
											<input class="form-control"  type="datetime-local" name="DataFinal" </td>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-lg">
									Filtrar
								</button>
							</div>
							<div class="col-md-4">
								<div id="piechart"></div>
								<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
								
							</div>
						</form>
					</div>

					<?php
					

						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword); 
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

						$stmt=$conn->prepare("CALL RelatorioTransacoes(?,?,?,?,?,?,?,?,?)");

						$stmt->bindParam(1,$IdUsuario,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(2,$IdTipoTransacao,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(3,$IdBancoOrigem,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(4,$IdBancoDestino,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(5,$IdFormaPagamento,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(6,$idTipoMoeda,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(7,$dataInicial,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(8,$dataFinal,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);
						$stmt->bindParam(9,$IdCategoria,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);

						$stmt->execute();

					?>
					
					<?php 
					$arrayCategoriaNome = array();
					$arrayCategoriaValor = array();
					?>
					<table class="table">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									Data
								</th>
								<th>
									Tipo
								</th>
								<th>
									Categoria
								</th>
								<th>
									Origem
								</th>
								<th>
									Destino
								</th>
								<th>
									Forma de Pagamento
								</th>
								<th>
									Moeda
								</th>
								<th>
									Valor
								</th>
							</tr>
						</thead>
						<tbody>
							<?php while($linha = $stmt->fetch()){ ?>
								<tr>
									<td>
										<?php echo "{$linha['Id']}";?>
									</td>
									<td>
										<?php echo "{$linha['Data']}";?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['tipotransacaoNome']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['CategoriaNome']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['bancoOrigem']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['bancoDestino']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['formaPagamentoNome']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['NomeMoeda']}");?>
									</td>
									<td>
										<?php echo utf8_encode("{$linha['Valor']}");
										$arrayCategoriaValor[$linha['CategoriaNome']] = (array_key_exists($linha['CategoriaNome'], $arrayCategoriaValor) ? $arrayCategoriaValor[$linha['CategoriaNome']] : 0) + $linha['Valor'];
										$arrayCategoriaNome[$linha['CategoriaNome']] = $linha['CategoriaNome'];
										
										?>
									</td>
								</tr>
							<?php }?>
						</tbody>
					</table>
					<script type="text/javascript">
									// Load google charts
									google.charts.load('current', {'packages':['corechart']});
									google.charts.setOnLoadCallback(drawChart);

									// Draw the chart and set the chart values
									function drawChart() {
									  var data = google.visualization.arrayToDataTable([
									  
									  ['Categoria', 'Valor'],
									  <?php 
												foreach ($arrayCategoriaNome as &$value) {	
													echo "['";
													echo utf8_encode($value);
													echo "',";
													echo $arrayCategoriaValor[$value];
													echo "],";
													echo "\r\n";
												}
												
											?>
									]);

									  // Optional; add a title and set the width and height of the chart
									  var options = {'title':'Por Categoria', 
									  'width':550, 
									  'height':400,
									  pieHole: 0.4};

									  // Display the chart inside the <div> element with id="piechart"
									  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
									  chart.draw(data, options);
									}
								</script>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>