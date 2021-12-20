<?php
	date_default_timezone_set("Etc/GMT-1");
	$url = "http://$server/";

	if($permissao == 1){
		$yP ='	<li><a href="?pg=produto/produto" class="">Produto</a></li>
		<li><a href="?pg=produto/cadastro" class="">Adiconar</a></li>';
	}else{
		$yP= '<li><a href="?pg=produto/produto" class="">Produto</a></li>';
	}
								
	if($permissao == 1){
		$yI ='	<li><a href="?pg=itens/itens" class="">Itens</a></li>
				<li><a href="?pg=itens/cadastro" class="">Adiconar</a></li>';
	}else{
		$yI= '<li><a href="?pg=itens/itens" class="">Itens</a></li>';
	}	
	if($permissao == 1){
		$yF ='	<li><a href="?pg=fabricante/fabricante">Fabricante</a></li>
				<li><a href="?pg=fabricante/cadastro">Adiciona</a></li>';
	}else{
		$yF= '<li><a href="?pg=fabricante/fabricante">Fabricante</a></li>';
	}	
	if($permissao == 1){
		$yU ='	<li><a href="?pg=usuario/usuario">Usuario</a></li>
				<li><a href="?pg=usuario/cadastro">Adiciona</a></li>
				<li><a href="destroy.php">Sair</a></li>';
	}else{
		$yU= '<li><a href="?pg=usuario/usuario">Usuario</a></li>
				<li><a href="destroy.php">Sair</a></li>';
	}
	if($permissao == 1){
		$yV ='	<li><a href="?pg=venda/venda">Venda</a></li>';
	}else{
		$yV= '<li><a href="?pg=venda/venda">Venda</a></li>
				<li><a href="?pg=venda/cadastro">Efetuar a venda</a></li>';
	}							
	$header='
	<body>
	<div>
		<!----Inicio de Header o cabeçalho de sistema---->
		<header class="navbar-default header">
			<div class="container">
				<button type="button" class="navbar-toggle collapsed " data-toggle="collapse" 
						data-target="#barra-navegacao">
						<span class="icon-bar"></span>	
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				</button>

				<!--Inicio de logo-->
				<div class="navbar-header">
					<a href="" class="navbar-brand">LOGO</a>
				</div>
				<!-- Fim de Logo--->

				<!---Inicio de barra de navegação---->
				<nav class="collapse navbar-collapse" id="barra-navegacao">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="link-nav dropdown-toggle" data-toggle="dropdown">Produto
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								'.$yP.'
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="link-nav dropdown-toggle" data-toggle="dropdown">
								Itens <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								'.$yI.'
							<li><a href="?pg=itens/balanco" class="">Balanço</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="link-nav dropdown-toggle" data-toggle="dropdown">
								Fabricante<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								'.$yF.'
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="link-nav dropdown-toggle" data-toggle="dropdown">
								Venda<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								'.$yV.'
								<li><a href="?pg=venda/relatorio">Relatórios</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="link-nav dropdown-toggle" data-toggle="dropdown">
								Usuario<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								'.$yU.'
							</ul>
						</li>
					</ul>
				</nav>
				<!---Fim de barra de navegação---->
			</div>
		</header>
		<!---Fim do cabeçalho---->
		<section class="">
	';
$footer='

</div>
	<script type="text/javascript"src="'.$url.'dist/bootstrap/js/jquery.js"></script>
	<script type="text/javascript"src="'.$url.'dist/js/main.js"></script>
	<script type="text/javascript"src="'.$url.'dist/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript"src="'.$url.'dist/js/valida.js"></script>
</body>

</html>';






?>