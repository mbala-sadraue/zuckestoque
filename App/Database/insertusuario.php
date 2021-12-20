<?php 


if(isset($_POST["cadastra"]) || isset($_POST["Editar"])){
	require '../Models/usuario.class.php';

	$nome			=	addslashes($_POST["nome_usuario"]);
	$telefone		=	addslashes($_POST["telefone"]);
	$nascimento		=	addslashes($_POST["nascimento"]);
	$sexo			=	addslashes($_POST["sexo"]);
	$permissao		=	addslashes($_POST["permissao"]);
	$user			=	addslashes($_POST["usuario"]);
	$imagem			= null;
	$ativo 			= 1;


	if($_POST["cadastra"] == "cadastra_usuario"){

		$senha		=	sha1($_POST["senha"]);
		$usuario 	= new Usuario();
		$dados		= array(1=>$nome,$telefone,$sexo,$nascimento,$user,$senha,$permissao,$ativo,$imagem);
		$usuario->cadastraUsuario($dados);
	}else if($_POST["Editar"] == "editar_usuario"){
		$idUsuario	= $_POST["idUsuario"];

		$usuario 	= new Usuario();
		$dados		= array(1=>$nome,$telefone,$sexo,$nascimento,$user,$permissao,$idUsuario);
		$usuario->atualizarUsuario($dados);
	}	
}




 ?>