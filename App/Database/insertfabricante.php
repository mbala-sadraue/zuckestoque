<?php 
	if(isset($_POST["cadastra"])|| isset($_POST["Editar"])){
		/*RECEBENDO DADOS DO FABRICANTE VIA POST*/
		$nome 			=	addslashes($_POST["nome_fabricante"]);
		$telefone 		=	addslashes($_POST["telefone"]);
		$email 			=	addslashes($_POST["email"]);
		$endereco 		=	addslashes($_POST["endereco"]);
		$ativo			= 1;
		$idUser			= 	$_POST["idUsuario"];
		
		require_once '../Models/fabricante.class.php';
		$fabricante = new Fabricante();
		if(isset($_POST["cadastra"]) && $_POST["cadastra"] == "cadastra_fabricante"){
			$dados 	= array(1=>$nome,$telefone,$email,$endereco,$ativo,$idUser);
			$fabricante->cadastraFabricante($dados);
			
		}else if(isset($_POST["Editar"])&& $_POST["Editar"] == "editar_fabricante"){
			$idFabricante	= $_POST["idFabricante"];
			$dados 	= array(1=>$nome,$telefone,$email,$endereco,$idFabricante);
			$fabricante->atualizarFabricante($dados);
		}	
	}









 ?>