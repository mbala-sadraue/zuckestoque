<?php 

	require_once 'connection.php';

	/*
		CADASTRA USUARIO NA TABELA USUARIO
	*/
	class Usuario extends Connect{

		public function cadastraUsuario($dados)
		{

			try {
				if(is_array($dados)){
					$cadastra  = $this->con->prepare("INSERT INTO usuario VALUES(DEFAULT,?,?,?,?,?,?,?,?,?)");

					foreach($dados as $k => $v)
					{
						$cadastra->bindValue($k,$v);
					}

					$cadastra->execute();

					if($cadastra->rowCount() == 1){
						header("location:../../views/?pg=usuario/usuario&m=1");
					}else{
						header("location:../../views/?pg=usuario/usuario&m=0");
					}
				}
				
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}
		}

		public function atualizarUsuario($dados)
		{

			try {
				if(is_array($dados)){
					$atualizar  = $this->con->prepare("UPDATE usuario SET NomeUsuario = ?,TelefoneUsuario = ?,
						Sexo = ?,Nascimento = ?,Login= ?,tipoPerminssao = ? WHERE idUsuario = ?
						");

					foreach($dados as $k => $v)
					{
						$atualizar->bindValue($k,$v);
					}

					$atualizar->execute();

					if($atualizar->rowCount() == 1){
						header("location:../../views/?pg=usuario/usuario&m=1");
					}else{
						header("location:../../views/?pg=usuario/usuario&m=0");
					}
				}
				
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}
		}

		public function listarUsuario($public)
		{

			try {

				$listar  = $this->con->prepare("SELECT * FROM usuario WHERE User_ativo = ?");
				$listar->bindValue(1,$public);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados 	= array();
					$dados	= $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;
				}else{
					return 0;
				}
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}

		}


		public function buscarDadosUsuario($idUser)
		{

			try {

				$listar  = $this->con->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
				$listar->bindValue(1,$idUser);
				$listar->execute();

				if($listar->rowCount() == 1){
					$dados 	= array();
					$dados	= $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;
				}else{
					return 0;
				}
			} catch (PDOException $e) {
				echo "Erro ".$e->getMessage();
			}

		}

		public function ativoUsuario($value,$id)
		{

			try {
				
				if($value == 1){
					$v = 0;
				}else{
					$v = 1;
				}

				$ativo = $this->con->prepare("UPDATE  usuario SET User_ativo = ? WHERE idUsuario = ? ");
				$ativo->bindValue(1,$v);
				$ativo->bindValue(2,$id);
				$ativo->execute();
				if($ativo->rowCount() == 1){
					header("location:../../views?pg=usuario/usuario");
				}
			} catch (Exception $e) {
				
			}
		}

	}









 ?>