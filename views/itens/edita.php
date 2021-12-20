<?php
if(isset($_GET["ac"]) && isset($_GET["idItem"]) &&$_GET["idItem"]>0){

		require '../App/Models/itens.class.php';
		require '../App/Models/produto.class.php';
		$idItem 	= $_GET["idItem"];
		$itens 		= new Itens();
		$produto 	= new Produto();
		$dados 		= $itens->buscaDadosItens($idItem);
		$dadosP		= $produto->listarProduto(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Editar item</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php 
require_once '../layout/layout.php';
echo $header;
echo'

	<div class="container-header">
		<div><h1>Editar item</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->';
			if($dados){
	echo'	<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertitens.php" class="modal" id="form_modal_edita">
					<div class=""id="form_cadastra">';
						$d = new arrayIterator($dados);
						while($d->valid()){
							
					echo'
						<div class="form-group">
							<label for="nome">Nome Produto</label>
							<select name="idProduto" class="form-control">';
							
								
									if($dados != 0){
										$dP 	= new arrayIterator($dadosP);
										while($dP->valid()){
											if($dP->current()->idProduto == $d->current()->Produto_idProduto){
												$selected= "selected";
											}else{
												$selected="";
											}
											echo '<option '.$selected.' value="'.$dP->current()->idProduto.'">'.$dP->current()->NomeProduto.', '.$dP->current()->Descricao.'</option>';
											$dP->next();
										}
									}
							
					echo	'</select> 
						</div>
						<div class="form-group">
							<label for="t">Quantidade</label>
							<input type="number" id="t"name="QuantItens" value="'.$d->current()->QuantItens.'" min="1" class="form-control" placeholder="Digite quantidade de produto "required >
						</div>
						<div class="form-group">
							<label for="e">Valor da compra</label>
							<input type="number" min="1" id="e"name="ValorCompraItem" value="'.$d->current()->ValorCompraItem.'" class="form-control" placeholder="Digite o valor que custou " required >
						</div>
						<div class="form-group">
							<label for="vv">Valor da Venda</label>
							<input type="number" min="1" id="vv"name="ValorVendaItem" value="'.$d->current()->ValorVendaItem.'" class="form-control" placeholder="Digite o valor que sera vendido " required >
						</div>
						<div class="form-group">
							<label for="m">Data da compra</label>
							<input type="date" id="m"name="DataCompraItem" value="'.$d->current()->DataCompraItem.'"  class="form-control"  required>
						</div>
						<div class="form-group">
							<label for="dv">Data de Vencimento</label>
							<input type="date" id="dv"name="DataVencimentoItem" value="'.$d->current()->DataVencimentoItem.'" class="form-control"  required>
						</div>
						
						<input type="hidden" name="idItens" value="'.$d->current()->idItem.'">
						<!--<input type="hidden" name="idUsuario" value="'.$idUsuario.'">-->
						';
							$d->next();
						}
						echo'
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="Editar" value="editar_itens">
						     Registra
						</button>
						</div>
				</div>
				</form>
			</div>
			<!-- Formulário-->
			<div class="col-sm-6" >
				
			</div>';
			}else{
				echo "Não foi encontra dados";
			}
			echo'
		</div>
	</div>';


	echo $footer;
}else{
	header("location:?pg=usuario/usuario");
}

?>