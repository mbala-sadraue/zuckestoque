<?php  

if(isset($_GET["ac"]) && $_GET["ac"]== "removeItem" && isset($_GET["idProduto"]) && $_GET["idProduto"]>0){

	require_once'../Models/carrinho.php';
	$idProduto = 	$_GET["idProduto"];
	unset($_SESSION["itens"][$idProduto]);
	//echo'<meta http-equiv="refresh" content="0,URL">'
	echo'<script>window.location.href="../../views?pg=venda/cadastro"</script>';
}

if(isset($_GET["ac"]) && $_GET["ac"]== "canselaVenda" ){

	require_once'../Models/carrinho.php';
	unset($_SESSION["itens"]);
	//echo'<meta http-equiv="refresh" content="0,URL">'
	echo'<script>window.location.href="../../views?pg=venda/cadastro"</script>';
}


?>