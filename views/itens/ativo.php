<?php 
	if(isset($_POST["idUser"]) && isset($_POST["status"]) && isset($_POST["id"])){
		$idItens 	= $_POST["id"];
		$value		= $_POST["status"];
		require_once "../../App/Models/itens.class.php";

		$itens = new Itens();

		$itens->ativoItem($value,$idItens);
		
		
	}else{
		header("location:../?pg=itens/itens");
	}
 ?>