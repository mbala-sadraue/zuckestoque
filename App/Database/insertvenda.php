<?php 

if((isset($_POST["venda"]) && $_POST["venda"]=="efectuar_venda" && isset($_POST["idUsuario"]) && isset($_POST["id_Item"]))){
	$idUsuario		= 	$_POST["idUsuario"];
	$idItem 		= 	$_POST["id_Item"];
	$quanItem 		= 	$_POST["quant_Item"];
	$Preco			= 	$_POST["preco_Item"];
	$valor			= 	$_POST["total"];
	$nomeCliente	= 	$_POST["nomeCliente"];

	/*cart*/
	$cart			= MD5("@$nomeCliente".date("d-m-Y h:i:s"));
	if($idItem!= null && $quanItem>0){
		require '../Models/itens.class.php';
		require '../Models/venda.class.php';
		$itens = new Itens();
		$venda = new Venda();
		foreach($idItem as $k => $v){
			$iditem = $k;
			$quant  = $quanItem[$k];
			$preco 	= $Preco[$k];
			$dados = $itens->verificaQuantItens($iditem,$quant);
			if($dados["status"]==1){
				$venda->cadastraVenda($iditem,$quant,$preco,$valor,$nomeCliente,$cart,$idUsuario);

			}else{
				header("location:../../views/?pg=venda/cadastro&q=".$dados["estoque"]."");
			}
			

		}
	}else{
		echo "string";
	}
}else{
	header("location:../../views/?pg=venda/cadastro");
}
?>