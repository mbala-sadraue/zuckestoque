<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Relatório das vendas</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
	<style type="text/css">
	
	td{
		border:1px solid #000 !important;
		text-align: left;
	}

</style>
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
	
echo '

<div class="container-header">
	<h1>Relatório das vendas</h1>
</div>
<div class="container">
	
	<div class=" background">
		<div class=" style-form con">';
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];

				unset($_SESSION["msg"]);
			}
		
				echo'
			<div class="">
				';

		echo'			';
						require_once"../App/Models/relatorio.class.php";
						$relatorio = 	new MostraRelatorio();
						$relatorio->mostraNotaVendaDiario();

						
				echo '

			</div>
		</div>
	</div>
</div>';
	
	echo $footer;
}else{
	header("location:../destroy.php");
}
?>