<?php 
	require_once 'connection.php';

	class Produto extends Connect
	{
		/*Função para cadastra produto*/
		public function cadastraProduto( $nome,$descricao,$marca,$ativo,$idFabricante,$idUser,$imagem)
		{
			try {

				$cadastra = $this->con->prepare("INSERT INTO produto VALUES(DEFAULT,?,?,?,?,?)");
				$cadastra->bindValue(1,$nome);
				$cadastra->bindValue(2,$descricao);
				$cadastra->bindValue(3,$ativo);
				$cadastra->bindValue(4,$idUser);
				$cadastra->bindValue(5,$imagem);
				$cadastra->execute();

				if($cadastra->rowCount()==1){
					$idProduto = $this->con->lastInsertId();

					/*CADASTRA OS DADOS DA MARCA DO PRODUTO NA TABELA MARCA*/
					$cadastraM = $this->con->prepare("INSERT INTO marca VALUES(DEFAULT,?,?,?)");
					$cadastraM->bindValue(1,$marca);
					$cadastraM->bindValue(2,$idProduto);
					$cadastraM->bindValue(3,$idFabricante);
					$cadastraM->execute();

					if($cadastraM->rowCount() ==1){
						header("location:../../views/?pg=produto/produto");
					}
				}

			} catch (Exception $e) {
				echo "Erro ".$e->getCode();
			}
			
		}
		/*Função para atualizar os dados do produto*/
		public function atualizarProduto( $nome,$descricao,$marca,$idFabricante,$idProduto)
		{
			try {

				$atualizar = $this->con->prepare("UPDATE produto SET NomeProduto = ?,Descricao = ? WHERE idProduto =? ");
				$atualizar->bindValue(1,$nome);
				$atualizar->bindValue(2,$descricao);
				$atualizar->bindValue(3,$idProduto);
				$atualizar->execute();

				/*CATUALIZA OS DADOS DA MARCA DO PRODUTO NA TABELA MARCA*/
				$cadastraM = $this->con->prepare("UPDATE marca SET NomeMarca = ?,fabri_idFabricante = ? WHERE pro_idProduto = ?");

				$cadastraM->bindValue(1,$marca);
				$cadastraM->bindValue(2,$idFabricante);
				$cadastraM->bindValue(3,$idProduto);
				$cadastraM->execute();

				if($cadastraM->rowCount() == 1){
					header("location:../../views/?pg=produto/produto");
				}else{
					header("location:../../views/?pg=produto/produto&m=0");
				}
				

			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}
			
		}
		/*FNÇÃO PARA LISTAR OS PRODUTOS*/
		public function listarProduto($public)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM produto JOIN marca ON produto.idProduto = marca.pro_idProduto JOIN fabricante ON marca.fabri_idFabricante = fabricante.idFabricante WHERE Pro_ativo = ?");
				$listar->bindValue(1,$public);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = array();
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;

				}else{

					return $dados = 0;
				}
			} catch (Exception $e) {
				
			}
		}
		/*FNÇÃO PARA RETORNAR OS DADOS DO PRODUTOS PARA SER EDITADTO*/
		public function buscaDadosProduto($idProduto)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM produto JOIN marca ON produto.idProduto = marca.pro_idProduto  WHERE idProduto =?");
				 $listar->bindValue(1,$idProduto);
				 $listar->execute();

				if($listar->rowCount()==1){
					$dados = array();
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;

				}else{

					return $dados = 0;
				}
			} catch (Exception $e) {
				
			}
		}
		/*FUNÇÃO PARA ATIVAR E DESATIVAR PRODUTO*/
		public function ativoProduto($value,$id)
		{

			try {
				
				if($value == 1){
					$v = 0;
				}else{
					$v = 1;
				}

				$ativo = $this->con->prepare("UPDATE  produto SET Pro_ativo = ? WHERE idProduto = ? ");
				$ativo->bindValue(1,$v);
				$ativo->bindValue(2,$id);
				$ativo->execute();
				if($ativo->rowCount() == 1){
					header("location:../../views?pg=produto/produto");
				}
			} catch (Exception $e) {
				
			}
		}
	}// Fim class do Produto

 ?>