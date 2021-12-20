
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastra itens</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php 
require_once '../layout/layout.php';
require_once'../App/Models/produto.class.php';
$produto = new Produto();
echo $header;

?>

	<div class="container-header">
		<div><h1>Cadastra itens</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->
			<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertitens.php">
					<div class=""id="form_cadastra">
						<div class="form-group">
							<label for="nome">Nome Produto</label>
							<select name="idProduto" class="form-control">
							<?php
								$dados	= $produto->listarProduto(1);
									if($dados != 0){
										$d 	= new arrayIterator($dados);
										while($d->valid()){

											echo '<option value="'.$d->current()->idProduto.'">'.$d->current()->NomeProduto.'</option>';
											$d->next();
										}
									}
							?>
							</select> 
						</div>
						<div class="form-group">
							<label for="t">Quantidade</label>
							<input type="number" id="t"name="QuantItens" min="1" class="form-control" placeholder="Digite quantidade de produto "required >
						</div>
						<div class="form-group">
							<label for="e">Valor da compra</label>
							<input type="number" min="1" id="e"name="ValorCompraItem" class="form-control" placeholder="Digite o valor que custou " required >
						</div>
						<div class="form-group">
							<label for="vv">Valor da Venda</label>
							<input type="number" min="1" id="vv"name="ValorVendaItem" class="form-control" placeholder="Digite o valor que sera vendido " required >
						</div>
						<div class="form-group">
							<label for="m">Data da compra</label>
							<input type="date" id="m"name="DataCompraItem"  class="form-control"  required>
						</div>
						<div class="form-group">
							<label for="dv">Data de Vencimento</label>
							<input type="date" id="dv"name="DataVencimentoItem"  class="form-control"  required>
						</div>
						<input type="hidden" id=""name="idUsuario" value="<?php echo$idUsuario?>" class="form-control"/>
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="cadastra" value="cadastra_itens">
						     Registra
							</button>
						</div>
				</div>
				</form>
			</div>
			<!-- Formulário-->
			<div class="col-sm-6" >
				
			</div>
		</div>
	</div>


<?php
echo $footer;


?>