<?php 
if (isset($_POST["busca"]) && $_POST["busca"]=="busca") {
	

	if(isset($_POST["query"]) && $_POST["query"] != ""){
		$value = $_POST["query"];
		require '../Models/itens.class.php';
		$itens = new Itens();
		 $itens->pesquisaDadosItens($value);
	}

}
 ?>