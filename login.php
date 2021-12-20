<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Logar no sistema</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/css/estilo2.css" />
</head>
<body>
	<section>
		<div class="container">
			<div class="container_caixa">
				<div class="caixa_center">
					<!---botão---->
					<button type="button" data-toggle="modal" data-target="#caixa_formulario" class="btn_login">
					Entrar no sistema
				</button>

					<!---Modal de form--->
					<form method="post" action="config/session.php" class=" modal fade" id="caixa_formulario" >
						<div class="modal-dialog">
							<div class="modal-content">
								<!-- Cabeçalho de modal-->
								<div class="modal-header">
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
									<h4 class="modal-title">Logar no sistema </h4>
								</div>

								<!-- Corpo de modal-->
								<div class="modal-body">
									<div class="form-group">
										<label for="nome">Usuário</label>
										<input type="text" name="usuario" id="nome" class="form-control" 
												placeholder="Digite  usuario" required="" />
									</div>
									<div class="form-group">
										<label for="senha">Senha</label>
										<input type="password" name="password" id="senha" class="form-control"
											    placeholder="Digite a tua senha" required="" />
									</div>
								</div>

								<!-- Rodapé de modal-->
								<div class="modal-footer">
									<button class="btn btn-primary btn-block" data-dismiss="modal">Canselar</button>
									<button type="submit" name="acao" value="logar" id="btn_logar" class="btn btn-danger  btn-block" >Logar
									</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>	
		</div>
	</section>
	<script type="text/javascript"src="dist/bootstrap/js/jquery.js"></script>
	<script type="text/javascript"src="dist/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript"src="dist/js/valida.js"></script>
</body>
<?php echo sha1("211620");?>
</html>