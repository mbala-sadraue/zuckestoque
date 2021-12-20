<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Balanço dos itens</title>
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
	
echo '

<div class="container-header">
	<h1>Lista de Itens</h1>
</div>
<div class="">
	
	<div class=" background">
		<div class="col-sm-12 style-form table-bordered table-hover table-condensed">';
		$dados	= $itens->listarItens($public);
		if($dados != 0){
			$d 	= new arrayIterator($dados);
		echo'
			<table class="table table-striped table-condensed">
				<thead>
					<tr class="tr-thead">
						
						<th>Nome do Produto</th>
						<th>Descrição</th>
						<th>Marca</th>
						<th title="Quanidade de Produto">Q.Comprado</th>
						<th title="Quanidade Vendido">Q.Vendido</th>
						<th title="Quanidade em Estoque">Q.Estoque</th>
						<th title="Valor da Compra">V. Compra</th>
						<th title="Valor da Venda">V. Venda</th>
						<th title="Loucro">Loucro</th>
				</thead>
				<tbody>';
					while($d->valid()){
						$ativo 		= $d->current()->itens_ativo;
						$idItem		= $d->current()->idItem;
						if($ativo == 1){
							$checked ="checked";
						}else{
							$checked = "";
						}
						$quant = $d->current()->QuantItens;
						$vCompra = $d->current()->ValorCompraItem;
						$vVenda  = $d->current()->ValorVendaItem;
						$subVCompra = $vCompra * $quant;
						$subVVenda = $vCompra * $d->current()->QuantItensVendido;
						$ganho = $vVenda * $quant;
						$loucro =  $ganho-$subVCompra;
				echo'
					<tr class="tr-tbody">
						
						<td>'.$d->current()->NomeProduto.'</td>
						<td>'.$d->current()->Descricao.'</td>
						<td>'.$d->current()->NomeMarca.'</td>
						<td>'.$quant.'</td>
						<td>'.$d->current()->QuantItensVendido.'</td>
						<td>'.$d->current()->QItemEstoque.'</td>
						<td>'.number_format($subVCompra,2,",",".").'</td>
						<td>'.number_format($ganho,2,",",".").'</td>
						<td>'.number_format($loucro,2,",",".").'</td>	
					</tr>

					';					
						$d->next();
					}
			echo'</tbody>
			</table>';
				}else{
					echo' <h2 class=" me">Nenhum dado '.$dadoEstatus.' encontrado </h2><span class="gyphicon glyphicon-bancircle"></span>';
				}
			echo'<div class="row">
				<div class="container">
					<div class>
					<form method="post">
						<button name="public" value="'.$public.'" class="btn btn-danger">'.$btnNome.'</button>
					</form>
					</div>
				<div>
			</div>
		</div>
	</div>
</div>';
	
	echo $footer;
}else{
	header("location:../destroy.php");
}
?>