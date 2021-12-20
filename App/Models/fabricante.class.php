<?php 
	require_once 'connection.php';
	class Fabricante extends Connect{

		public function cadastraFabricante($dados)
		{
			try {
				if(is_array($dados)){
					$cadastra  = $this->con->prepare("INSERT INTO fabricante VALUES(DEFAULT,?,?,?,?,?,?)");

					foreach($dados as $k => $v)
					{
						$cadastra->bindValue($k,$v);
					}

					$cadastra->execute();

					if($cadastra->rowCount() == 1){
						header("location:../../views/?pg=fabricante/fabricante&m=1");
					}else{
						header("location:../../views/?pg=fabricante/fabricante&m=0");
					}
				}
				
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}
		}

		public function atualizarFabricante($dados)
		{
			try {
				if(is_array($dados)){
					$atualizar  = $this->con->prepare("UPDATE fabricante SET NomeFabricante = ?,TelefoneFabricante =?,
							EmailFabricante = ?, EnderecoFabricante = ? WHERE idFabricante = ?
						");

					foreach($dados as $k => $v)
					{
						$atualizar->bindValue($k,$v);
					}

					$atualizar->execute();

					if($atualizar->rowCount() == 1){
						header("location:../../views/?pg=fabricante/fabricante&m=1");
					}else{
						header("location:../../views/?pg=fabricante/fabricante&m=0");
					}
				}
				
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}
		}
		/*FNÇÃO PARA LISTAR OS FABRICANTE*/
		public function listarFabricante($public)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM fabricante  WHERE Fabricante_ativo = ?");
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

		/*FNÇÃO PARA BUSCA OS DADOS DO FABRICANTE  PARA SER EDITA*/
		public function buscaDadosFabricante($idFabricante)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM fabricante  WHERE idFabricante = ?");
				$listar->bindValue(1,$idFabricante);
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

		/*FUNÇÃO PARA ATIVAR E DESATIVAR FABRICANTE*/
		public function ativoFabricante($value,$id)
		{

			try {
				
				if($value == 1){
					$v = 0;
				}else{
					$v = 1;
				}

				$ativo = $this->con->prepare("UPDATE  fabricante SET Fabricante_ativo = ? WHERE idFabricante = ? ");
				$ativo->bindValue(1,$v);
				$ativo->bindValue(2,$id);
				$ativo->execute();
				if($ativo->rowCount() == 1){
					header("location:../../views?pg=fabricante/fabricante&m=1");
				}else{
					header("location:../../views?pg=fabricante/fabricante&m=0");
				}
			} catch (Exception $e) {
				
			}
		}


	}//FIM DA CLASS 
 ?>