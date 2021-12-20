<?php
if(isset($_GET["ac"]) && isset($_GET["idProduto"]) &&$_GET["idProduto"]>0){

		require '../App/Models/produto.class.php';
		require_once '../App/Models/fabricante.class.php';
		$idProduto = $_GET["idProduto"];
		$produto = new Produto();
		
		$dados = $produto->buscaDadosProduto($idProduto);

		$fabricante = new Fabricante();
		$public = 1;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Editar Produto</title>
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
		<div><h1>Editar produto</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->';
			if($dados){

			
	echo'	<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertproduto.php" class="modal" id="form_modal_edita">
					<div class=""id="form_cadastra">';
						$d = new arrayIterator($dados);
						while($d->valid()){
					echo'
						<div class="form-group">
							<label for="nome">Nome Produto</label>
							<input type="" id="nome"name="nome_produto" value="'.$d->current()->NomeProduto.'"class="form-control" placeholder="Digite nome do produto"required >
						</div>
						<div class="form-group">
							<label for="desci">Descrição</label>
							<input type="" id="desci"name="descrisao_produto" value="'.$d->current()->Descricao.'" class="form-control" placeholder="Digite a descrição do produto" required>
						</div>
						<div class="form-group">
							<label for="marca">Marca</label>
							<input type="" id="marca"name="marca_produto"value="'.$d->current()->NomeMarca.'" class="form-control" placeholder="Digite a marca do produto" required>
						</div>
						<div class="form-group">
							<label for="fa">Fabricante</label>
							<select name="fabricante_produto" class="form-control">
							';

							
									$dados2	= $fabricante->listarFabricante($public);
										if($dados2 != 0){
											$d2 	= new arrayIterator($dados2);
											while($d2->valid()){
												$selected = ($d2->current()->idFabricante == $d->current()->fabri_idFabricante)?"selected":"";
												echo' <option '.$selected.' value="'.$d2->current()->idFabricante.'">'.$d2->current()->NomeFabricante.'</option>';
												$d2->next();
											}
										}
						echo '
							</select>
						</div>
						
						<input type="hidden" name="idProduto" value="'.$d->current()->idProduto.'">
						';
							$d->next();
						}
						echo'
						<input type="hidden" name="idUsuario" value="'.$idUsuario.'">
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="ac" value="editar_produto">
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
	header("location:?pg=produto/produto");
}

?>