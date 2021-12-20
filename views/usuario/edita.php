<?php
if(isset($_GET["ac"]) && isset($_GET["idUsuario"]) &&$_GET["idUsuario"]>0){

		require '../App/Models/usuario.class.php';
		$idUsuario = $_GET["idUsuario"];
		$usuario = new Usuario();
	
		$dados = $usuario->buscarDadosUsuario($idUsuario);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Editar Usuario</title>
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
		<div><h1>Editar usuario</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->';
			if($dados){
	echo'	<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertusuario.php" class="modal" id="form_modal_edita">
					<div class=""id="form_cadastra">';
						$d = new arrayIterator($dados);
						while($d->valid()){
							if($d->current()->Sexo ="Masculino"){
								$checkedM = "checked";
								$checkedF ="";	
							}else{
								$checkedM = "";
								$checkedF ="checked";	
							}
							if($d->current()->tipoPerminssao == 1){
								$selectedA = "selected";
								$selectedV ="";	
							}else{
								$selectedA = "";
								$selectedV ="selected";	
							}
					echo'
						<div class="form-group">
							<label for="nome">Nome de usuario</label>
							<input type="" id="nome"name="nome_usuario" value="'.$d->current()->NomeUsuario.'" class="form-control" placeholder="Digite nome de usuario"required >
						</div>
						<div class="form-group">
							<label for="nome">Telefone Usuario</label>
							<input type="" id="nome"name="telefone"  value="'.$d->current()->TelefoneUsuario.' "class="form-control" placeholder="Digite telefone "required >
						</div>
						<div class="form-group">
							<label for="nome">Data de nascimento</label>
							<input type="date" id="nome"name="nascimento" class="form-control"  value="'.$d->current()->Nascimento.'" required >
						</div>
						<div class="form-group">
							<label for="s">Masculino
								<input type="radio" id="s" name="sexo" value="Masculino" '.$checkedM.'>
							</label>
							<label for="s2">Femenino
								<input type="radio" id="s2" name="sexo" value="Femenino" '.$checkedF.'>
							</label>
							
						</div>
						<div class="form-group">
							<label for="nome">Usuario</label>
							<input type="" id="nome"name="usuario"  value="'.$d->current()->Login.'" class="form-control" placeholder="Digite o usuario" required>
						</div>
						<!--
						<div class="form-group">
							<label for="nome">Senha</label>
							<input type="password" id="nome"name="senha"  class="form-control" placeholder="Digite a senha "required>
						</div>
						-->
						<div class="form-group">
							<label for="nome">Permissão</label>
							<select name="permissao" class="form-control">
								<option value="1" '.$selectedA.'>Administrador</option>
								<option value="3" '.$selectedV.'>Vendedor</option>
							</select>
						</div>
						
						<input type="hidden" name="idUsuario" value="'.$d->current()->idUsuario.'">
						';
							$d->next();
						}
						echo'
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="Editar" value="editar_usuario">
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