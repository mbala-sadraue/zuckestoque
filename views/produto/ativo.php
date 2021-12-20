<?php 
	if(isset($_POST["idUser"]) && isset($_POST["status"]) && isset($_POST["id"])){
		$idProduto	= $_POST["id"];
		$value		= $_POST["status"];
		require_once "../../App/Models/produto.class.php";

		$produto = new produto();

		$produto->ativoProduto($value,$idProduto);
		
	}else{
		header("location:../?pg=produto/produto");
	}
 ?>