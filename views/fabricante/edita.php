<?php
if(isset($_GET["ac"]) && isset($_GET["idFabricante"]) && $_GET["idFabricante"]>0){

		require '../App/Models/fabricante.class.php';
		$idFabricante	= $_GET["idFabricante"];
		$fabricante 	= new Fabricante();
	
		$dados = $fabricante->buscaDadosFabricante($idFabricante);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Editar fabricante</title>
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
		<div><h1>Editar fabricante</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->';
			if($dados){
	echo'	<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertfabricante.php" class="modal" id="form_modal_edita">
					<div class=""id="form_cadastra">';
						$d = new arrayIterator($dados);
						while($d->valid()){
							
					echo'
						<div class=""id="form_cadastra">
						<div class="form-group">
							<label for="nome">Nome de Fabricante</label>
							<input type="" id="nome"name="nome_fabricante" value="'.$d->current()->NomeFabricante.'" class="form-control" placeholder="Digite nome de fabricante "required >
						</div>
						<div class="form-group">
							<label for="t">Telefone</label>
							<input type="" id="t"name="telefone" value="'.$d->current()->TelefoneFabricante.'" class="form-control" placeholder="Digite telefone "required >
						</div>
						<div class="form-group">
							<label for="e">E-mail</label>
							<input type="email" id="e"name="email" value="'.$d->current()->EmailFabricante.'" class="form-control" placeholder="Digite email " required >
						</div>
						<div class="form-group">
							<label for="m">Endereço</label>
							<input type="text" id="m"name="endereco" value="'.$d->current()->EnderecoFabricante.'" class="form-control" placeholder="Digite endereço" required>
						</div>
						<input type="hidden" name="idFabricante" value="'.$d->current()->idFabricante.'">
						';
							$d->next();
						}
						echo'
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="Editar" value="editar_fabricante">
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
	header("location:?pg=fabricante/fabricante");
}

?>