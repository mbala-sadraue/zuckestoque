
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Venda</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>
<style type="text/css">
	.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-9{
		padding-left: 0px;
	}
</style>

<?php 
if(isset($_SESSION["venda"]) && $_SESSION["venda"] == "sucesso"){
	unset($_SESSION["itens"],$_SESSION["venda"]);
}
if($permissao == 3){


require '../App/Models/itens.class.php';
if (isset($_POST["busca"]) && $_POST["busca"] == "busca_produto") {
	$valueProduto 	= $_POST["valorProduto"];
	$itens 			= new Itens();
	$dados 			= $itens->buscaDadosItensVenda($valueProduto);
	
	if($dados){
		$idItem			= $dados["idItem"];
		$nomeProduto 	= $dados["NomeProduto"];
	}
}
require_once '../layout/layout.php';
echo $header;
?>

	<div class="container-header">
		<div><h1>Efectuar vendar</h1></div>
	</div>
	<div class="container">
					
			<!-- Formulário-->
		<div class=" row background">
			<!-- Formulário-->
			
			<div class="style-form">
				<div class="">
					<?php

					if(isset($_SESSION["msg"])){
						echo $_SESSION["msg"];

						unset($_SESSION["msg"]);
					}
					?>
				</div>
				<div class="row">
					<form class="form form_search"  id="form_buscaProduto" method="post" action="">
						<div class="box-body">
							<div class="col-sm-8">
								<div class="form-group " >
									<div class="col-sm-9">
										<input type="search" id="searchProduto"name="valorProduto" class="form-control" placeholder="Digite o nome  ou id do produto"required />
									</div>
									
									<span class="input-group-btn col-sm-3">
										<button class="btn tbn-default" name="busca" value="busca_produto">
											<span class="glyphicon glyphicon-floppy-save "></span>
										</button>
									</span>
								</div>
								
									
							</div>
							<div class="col-sm-4">
									<div id="respostaProduto">Campo vazio</div>
								</div>
						</div>
					</form>
						
				</div>
		<form class="" method="post" action="../App/database/insertvenda.php"id="form_cadastra" >
			<div class="row">
				
				<div class="col-sm-12">	
					<div class="" >
						<div class="form-group " >
							<label for="nome">Nome Cliente</label>
							<input type="" id="nome"name="nomeCliente" class="form-control" placeholder="Digite nome do produto"required >

						</div>
						<div class="form-group col-sm-2">
							<label for="idItem">Código Produto</label>
							<input type="number"min="1" id="idItem"name="idItem" value="<?php if(isset($idItem)){echo $idItem;} ?>"class="form-control" placeholder="Digite id" >
						</div>
						<div class="form-group col-sm-4">
							<label for="nomeProduto">Nome Produto</label>
							<input type="text"min="1" id="nomeProduto"name="nomeProduto"value="<?php if(isset($idItem)){echo $nomeProduto;} ?>" class="form-control" placeholder="Digite a descrição do produto" >
						</div>
						<div class="form-group col-sm-3">
							<label for="QProduto">Quantidade</label>
							<input type="number" id="QProduto"name="marca_produto" class="form-control" placeholder="Digite a marca do produto" >
						</div>
						<div class="form-group col-sm-3"><br/>
							<button type="button" id="registroProduto"class="btn btn-primary btn-block ">Registrar</button>
						</div>
					</div>
				</div>	
					<!-- TABELA DE CARRINHO-->	
			</div>
			<div >
				<table class="table table-striped">
					<thead>
						<tr class="tr-thead">
							<th>#</th>
							<th>1</th>
							<th>Nome Produto</th>
							<th>Descrição</th>
							<th>Marca</th>
							<th>Preço</th>
							<th>Quant.</th>
							<th>Subtotal.</th>
							<th>Del.</th>

						</tr>
					</thead>
					<tbody id="carrinhoResposta">
						<?php

							$contS = (isset($_SESSION["itens"]))? count($_SESSION["itens"]):0;

				if($contS==0){
					echo '<tr><td colspan="9">Carrinho Vazio</td></tr>';
				}else{
					//require '../App/Models/itens.class.php';
					$itens = new Itens();
					$count = 1;
					$Total = 0;
					foreach ($_SESSION["itens"] as $idProduto => $quantidade) {
						$dados = $itens->buscaDadosItens($idProduto);
						if($dados){

								$dado = new arrayIterator($dados);
							while ($dado->valid()) {
								$idItem	 		= $dado->current()->idItem;
								$NomeProduto	= $dado->current()->NomeProduto;
								$Descricao		= $dado->current()->Descricao;
								$Marca 			= $dado->current()->NomeMarca;
								$Preco 			= $dado->current()->ValorVendaItem;
								$dado->next();
							}
								$subTotal 		= $Preco * $quantidade; 
								$Total 			+= $subTotal; 
							
					echo'

							<tr class="tr-venda">
								<td>'.$count.'</td>
								<td>'.$idItem.'
									<input type="hidden" name="id_Item['.$idProduto.']" value="'.$idProduto.'" />
								</td>
								<td>'.$NomeProduto.'</td>
								<td>'.$Descricao.'</td>	
								<td>'.$Marca.'</td>	
								<td>'.number_format($Preco,2,",",".").'
									<input type="hidden" name="preco_Item['.$idProduto.']" value="'.$Preco.'" />
								</td>	
								<td>'.$quantidade.'
									<input type="hidden" name="quant_Item['.$idProduto.']" value="'.$quantidade.'" />
								</td>	
								<td>'.number_format($subTotal,2,",",".").'</td>
								<td>
								<a href="../App/Database/remove.php?ac=removeItem&idProduto='.$idProduto.'" class="glyphicon glyphicon-trash"></a>
								</td>		
							</tr>

						';
							$count ++;

						}

						
					}

					echo '<tr>
							<td colspan="7">Total</td>
							<td colspan="">'.number_format($Total,2,",",".").'
								<input type="hidden" name="total" value="'.$Total.'" />
							</td>
							<td></td>
						</tr>
						<input type="hidden" nome"id_Item" value="'.$idProduto.'" />';

				}
				?>

					</tbody>
				</table>
				<input type="hidden" name="idUsuario"value="<?php echo$idUsuario?>">
				<div class="form-group">
					<button name="venda" value="efectuar_venda"class="btn btn-danger">Vender</button> <a href="../App/Database/remove.php?ac=canselaVenda" class="btn btn-primary" >Cansela</a>
				</div>
				
			
		</div>
	</form>
	</div>


<?php
echo $footer;


}else{
	header("location:../");
}
?>