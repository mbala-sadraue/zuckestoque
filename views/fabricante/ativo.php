<?php 
	if(isset($_POST["idFabricante"]) && isset($_POST["status"]) && isset($_POST["id"])){
		$idFabricante 	= $_POST["id"];
		$value		= $_POST["status"];
		require_once "../../App/Models/fabricante.class.php";

		$fabricante = new Fabricante();

		$fabricante->ativoFabricante($value,$idFabricante);
		
	}else{
		header("location:../?pg=fabricante/fabricante&a");
	}
 ?>