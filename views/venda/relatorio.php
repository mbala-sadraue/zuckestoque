<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Relatório das vendas</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php
 
if($permissao==1 || $permissao == 3){


	
	require_once'../layout/layout.php';

	require_once'../App/Models/itens.class.php';
	echo $header;
	$public =1;
	$itens = new Itens();
	if(isset($_POST["public"])){
		$public = $_POST["public"];
		if($public ==1){

			$public = 0;
			$btnNome = "Ativos";
			$dadoEstatus ="inativo";
		}else{
			$public = 1;
			$btnNome = "Inativos";
			$dadoEstatus ="ativo";
		}
	}else{
		$public = 1;
		$btnNome = "Inativos";
		$dadoEstatus ="ativo";
	}
	$query = $_SERVER["QUERY_STRING"];
	
	
echo '

<div class="container-header">
	<h1>Relatório das vendas</h1>
</div>
<div class="">
	
	<div class=" background">
		<div class=" style-form con">';
		
		echo'<div class="row text-center btn-relatorio">
				<a href="?pg=venda/relatorio&op=relatoriaDiario" class="btn btn-danger">Relatorio diario</a>
				<a href="?pg=venda/relatorio&op=relatoriaSemanal" class="btn btn-primary">Relatorio semanal</a>
				<a href="?pg=venda/relatorio&op=relatoriaMensal" class="btn btn-success">Relatorio mensal</a>
			</div>
			<div>
				<form class="text-center"method="get" action="#">
					<div class="col-sm-4"></div>
					<div class="form-group col-sm-4">
						<input type="date" class="form-control" name="" id="dataRelatorio">
					</div>
					<div class="col-sm-4"><button class="btn btn-primary" id="btnBuscaRelatorio">ver relatorio</button></div>
					</form>
			</div>
			<div class="">
				<table class="table table-striped">
					<thead class="">
						<tr class="tr-thead">
							<th>Nome de Produto</th>
						
							<th>Marca do Produto</th>
						
							<th>Descrição</th>
						
							<th>Quantidade Vendida</th>
						
							<th>Valor Vendida</th>

						</tr>

					</thead>

					<tbody>';
					if(isset($_GET["op"])){
						$op 	= 	$_GET["op"];
						require_once"../App/Models/relatorio.class.php";
						$relatorio = 	new MostraRelatorio();
						switch($op){
							case "relatoriaDiario":
								$data = date("Y-m-d");
								$relatorio->mostraRelatorioDiario($data);
							break;

							case "relatoriaSemanal":
							echo "Relatorio Semanal";
							break;

							case "relatoriaMensal":
								$relatorio->mostraMensal();
							break;

							case "relatorio":
								$data =  $_GET["data"];
								$relatorio->mostraRelatorioDiario($data);
							break;
							default :
							echo "A opção escolhida não foi encontrado";
							break;

						}
					}else{
						echo '<tr><td colspan="6">Escolha uma opção</td><tr>';
					}

						
			echo 	'</tbody>

				</table>

			</div>
		</div>
	</div>
</div>';
	
	echo $footer;
}else{
	header("location:../destroy.php");
}
?>