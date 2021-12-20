<?php 
session_start();
	require_once "../App/Models/connection.php";

	class Sessao extends Connect{

		public function logar()
		{
			print_r($this->con);
		}

		/**Função para logar**/

		public function logarSistema($user,$senha){
			$ativo = 1;
			try {
				$logar = $this->con->prepare("SELECT * FROM usuario WHERE  Login = ? && password = ? AND User_ativo = ?");
				$logar->bindValue(1,$user);
				$logar->bindValue(2,$senha);
				$logar->bindValue(3,$ativo);
				$logar->execute();
				if($logar->rowCount()==1){
					$dadosUsuario = $logar->fetch(PDO::FETCH_ASSOC);
					print_r($dadosUsuario);
					$_SESSION["dados"] = array();
					$_SESSION["dados"]["idLogin"] = $dadosUsuario["idUsuario"];
					$_SESSION["dados"]["permissao"] = $dadosUsuario["tipoPerminssao"];
					header("location:control.php");		
				}else{
					header("location:../login.php?alert=0");

				}
				
			} catch (Exception $e) {
				
			}
		}
	}

	if(isset($_POST["acao"]) &&  $_POST["acao"] == "logar"){
		if ($_POST["usuario"] != null && $_POST["password"] != null){
			$user = $_POST["usuario"];
			$senha = sha1($_POST["password"]);
			$sessao = new Sessao();
			$sessao->logarSistema($user,$senha);
		}

	}else{
		header("location:../login.php");
	}
	
 ?>