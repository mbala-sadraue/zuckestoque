<?php 
	if(isset($_POST["idUser"]) && isset($_POST["status"]) && isset($_POST["id"])){
		$idUser 	= $_POST["id"];
		$value		= $_POST["status"];
		require_once "../../App/Models/usuario.class.php";

		$usuario = new Usuario();

		$usuario->ativoUsuario($value,$idUser);
		
	}else{
		header("location:../?pg=usuario/usuario");
	}
 ?>