<?php 

if(isset($_POST["acao"]) && $_POST["acao"]== "elimina"){
	$cart = $_POST["cart"];
	if(!empty($cart)){

		require_once "../../App/Models/venda.class.php";
		$venda = new Venda();
		
		$venda->eliminaRegistroVenda($cart);
	}
}

 ?>