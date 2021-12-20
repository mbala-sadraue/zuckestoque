<?php 
session_start();
	$server = $_SERVER["HTTP_HOST"] ;
	$url = "http://".$server."/";


	if (isset($_SESSION["dados"]["idLogin"] ) && isset($_SESSION["dados"]["permissao"])){
		$permissao = $_SESSION["dados"]["permissao"];
		$idUsuario = $_SESSION["dados"]["idLogin"] ;
		
	} else {
		header("location:../destroy.php");
	}
 ?>