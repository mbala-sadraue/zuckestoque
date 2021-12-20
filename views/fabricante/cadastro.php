
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastra fabricante</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php 
require_once '../layout/layout.php';
echo $header;
?>

	<div class="container-header">
		<div><h1>Cadastra fabricante</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->
			<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertfabricante.php">
					<div class=""id="form_cadastra">
						<div class="form-group">
							<label for="nome">Nome de Fabricante</label>
							<input type="" id="nome"name="nome_fabricante" class="form-control" placeholder="Digite nome de fabricante "required >
						</div>
						<div class="form-group">
							<label for="t">Telefone</label>
							<input type="" id="t"name="telefone" class="form-control" placeholder="Digite telefone "required >
						</div>
						<div class="form-group">
							<label for="e">E-mail</label>
							<input type="email" id="e"name="email" class="form-control" placeholder="Digite email " required >
						</div>
						<div class="form-group">
							<label for="m">Endereço</label>
							<input type="text" id="m"name="endereco"  class="form-control" placeholder="Digite endereço" required>
						</div>
						<input type="hidden"name="idUsuario" value="<?php echo $idUsuario;?>" class="form-control"/>
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="cadastra" value="cadastra_fabricante">
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
