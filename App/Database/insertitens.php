<?php 
	if(isset($_POST["cadastra"])|| isset($_POST["Editar"])){
		/*RECEBENDO DADOS DO FABRICANTE VIA POST*/
		$idProduto 			=	addslashes($_POST["idProduto"]);
		$QuantItens 		=	addslashes($_POST["QuantItens"]);
		$VCItem 			=	addslashes($_POST["ValorCompraItem"]);
		$VVItem 			=	addslashes($_POST["ValorVendaItem"]);
		$DCItem 			=	addslashes($_POST["DataCompraItem"]);
		$DVItem 			=	addslashes($_POST["DataVencimentoItem"]);
		$idUsuario 			=	addslashes($_POST["idUsuario"]);
		$ativo				= 1;
		$QItensV			= 0;
		$QItensE			= $QuantItens;

		
		require_once '../Models/itens.class.php';
		$itens = new Itens();
		if(isset($_POST["cadastra"]) && $_POST["cadastra"] == "cadastra_itens"){
			$dados 	= array(1=>$idProduto,$QuantItens,$QItensV,$QItensE,$VCItem,$VVItem,$DCItem,$DVItem,$ativo,$idUsuario );
			$itens->cadastraItens($dados);
			
		}else if(isset($_POST["Editar"])&& $_POST["Editar"] == "editar_itens"){
			$idItens	= $_POST["idItens"];
			$dados 	= array(1=>$idProduto,$QuantItens,$VCItem,$VVItem,$DCItem,$DVItem,$idItens);

			$itens->atualizarItens($dados);
		}	
	}









 ?>