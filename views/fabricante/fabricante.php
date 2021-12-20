<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Lista dos fabricantes</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php
$perm = 1; 
if($perm==1){


	require_once'../App/Models/fabricante.class.php';
	require_once'../layout/layout.php';
	echo $header;
	$public =1;
	$fabricante = new Fabricante();
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
	<h1>Lista dos Fabricantes</h1>
</div>
<div class="container">
	
	<div class="row background">
		<div class="col-sm-12 style-form table-bordered table-hover table-condensed">';
		$dados	= $fabricante->listarFabricante($public);
		if($dados != 0){
			$d 	= new arrayIterator($dados);
		echo'
			<table class="table table-striped">
				<thead>
					<tr class="tr-thead">';
						if($permissao == 1){
						echo '<th title="ATIVAR OU DESATIVAR">A/D </th>';
						}
						
				echo'	<th>Nome</th>
						<th>Telefone</th>
						<th>Email</th>
						<th>Endereço</th>';
						if($permissao == 1){
						echo '<th>Editar </th>';
						}
						
						echo'
					</tr>
				</thead>
				<tbody>';
					while($d->valid()){
						$ativo 		= $d->current()->Fabricante_ativo;
						$idFabricante	= $d->current()->idFabricante;
						if($ativo == 1){
							$checked ="checked";
						}else{
							$checked = "";
						}
				echo'
					<tr class="tr-tbody">';
						if($permissao == 1){
						echo '
						<td>
							<form method="post" action="fabricante/ativo.php">
								<input type="hidden" name="id" value="'.$idFabricante.'"/>
								<input type="hidden" '.$checked.' name="status" value="'.$ativo.'"/>
								<input type="checkbox" '.$checked.' onclick="this.form.submit()"/>
								 <input type="hidden" name="idFabricante" value="1"/>
							</form>
						</td>';
						}
						
						echo'
						
						<td>'.$d->current()->NomeFabricante.'</td>
						<td>'.$d->current()->TelefoneFabricante.'</td>
						<td>'.$d->current()->EmailFabricante.'</td>
						<td>'.$d->current()->EnderecoFabricante.'</td>	
						';
						if($permissao == 1){	
				echo'	<td>
							<a href="?pg=fabricante/edita&idFabricante='.$idFabricante.'&ac=edita" class="glyphicon glyphicon-pencil"></a>
						</td>';
						}		
				echo'		
					</tr>

					';					
						$d->next();
					}
			echo'</tbody>
			</table>';
				}else{
					echo' <h2 class=" me">Nenhum registro '.$dadoEstatus.' encontrado. </h2><span class="gyphicon glyphicon-bancircle"></span>';
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
	header("location:../../destroy.php");
}
?>