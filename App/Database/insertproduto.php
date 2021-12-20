<?php 


	if (isset($_POST["ac"])  && isset($_POST["nome_produto"])){
		require '../Models/produto.class.php';
		/*RECEBENDO DADOS DO PRODUTO VIA POST*/
		$nome 			=	addslashes($_POST["nome_produto"]);
		$descricao 		=	addslashes($_POST["descrisao_produto"]);
		$marca 			=	addslashes($_POST["marca_produto"]);
		$fabricante 	=	addslashes($_POST["fabricante_produto"]);
		$imagem 		=	addslashes($_POST["imagem_produto"]);
		$idUser			= 	addslashes($_POST["idUsuario"]);
		$ativo 			= 1;
		$imagem 		= null;

		$produto = new Produto();
		if( $_POST["ac"]== "cadastra_produto"){
			$produto->cadastraProduto($nome,$descricao,$marca,$ativo,$fabricante,$idUser,$imagem);
		}else if($_POST["ac"]== "editar_produto" && isset($_POST["idProduto"])){

		echo	$idProduto = $_POST["idProduto"];
			$produto = new Produto();

			$produto->atualizarProduto($nome,$descricao,$marca,$fabricante,$idProduto);
		}

	}else{
		header("location:../../views/?pg=produto/produto");
	}

 ?>