
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastra usuario</title>
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
		<div><h1>Cadastra usuario</h1></div>
	</div>
	<div class="container">
		
		<div class="row background">
			<!-- Formulário-->
			<div class="col-sm-6">
				
				<form class="form style-form"  method="post" action="../App/database/insertusuario.php">
					<div class=""id="form_cadastra">
						<div class="form-group">
							<label for="nome">Nome de usuario</label>
							<input type="" id="nome"name="nome_usuario" class="form-control" placeholder="Digite nome de usuario"required >
						</div>
						<div class="form-group">
							<label for="nome">Telefone Usuario</label>
							<input type="" id="nome"name="telefone" class="form-control" placeholder="Digite telefone "required >
						</div>
						<div class="form-group">
							<label for="nome">Data de nascimento</label>
							<input type="date" id="nome"name="nascimento" class="form-control" required >
						</div>
						<div class="form-group">
							<label for="s">Masculino
								<input type="radio" id="s" name="sexo" value="Masculino" checked="">
							</label>
							<label for="s2">Femenino
								<input type="radio" id="s2" name="sexo" value="Femenino">
							</label>
							
						</div>
						<div class="form-group">
							<label for="nome">Usuario</label>
							<input type="" id="nome"name="usuario"  class="form-control" placeholder="Digite o usuario" required>
						</div>
						<div class="form-group">
							<label for="nome">Senha</label>
							<input type="password" id="nome"name="senha"  class="form-control" placeholder="Digite a senha "required>
						</div>
						<div class="form-group">
							<label for="nome">Permissão</label>
							<select name="permissao" class="form-control">
								<option value="1">Administrador</option>
								<option value="3">Vendedor</option>
							</select>
						</div>
						<div>
							<button type="submit" class="btn btn-danger btn-block" id="btn_cadastra"
								data-toggle="modal" data-target="#janela_erro" name="cadastra" value="cadastra_usuario">
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