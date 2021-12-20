
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Página Inicial</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php 
require_once '../layout/layout.php';
require_once '../App/Models/fabricante.class.php';
$fabricante 	= new Fabricante();
echo $header;
$public = 1;
?>

	<div class="container-header">
		<div><h1>Cadastra produto</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->
			<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertproduto.php">
					<div class=""id="form_cadastra">
						<div class="form-group">
							<label for="nome">Nome Produto</label>
							<input type="" id="nome"name="nome_produto" class="form-control" placeholder="Digite nome do produto"required >
						</div>
						<div class="form-group">
							<label for="nome">Descrição</label>
							<input type="" id="nome"name="descrisao_produto" class="form-control" placeholder="Digite a descrição do produto" required>
						</div>
						<div class="form-group">
							<label for="nome">Marca</label>
							<input type="" id="nome"name="marca_produto" class="form-control" placeholder="Digite a marca do produto" required>
						</div>
						<div class="form-group">
							<label for="nome">Fabricante</label>
							<select name="fabricante_produto" class="form-control">
								<?php
									$dados	= $fabricante->listarFabricante($public);
										if($dados != 0){
											$d 	= new arrayIterator($dados);
											while($d->valid()){

												echo '<option value="'.$d->current()->idFabricante.'">'.$d->current()->NomeFabricante.'</option>';
												$d->next();
											}
										}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="nome">Adiciona uma imagem</label>
							<input type="file" id="nome"name="imagem_produto" class="form-control">
						</div>
						<input type="hidden" name="idUsuario"value="<?php echo$idUsuario?>">
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="ac" value="cadastra_produto">
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