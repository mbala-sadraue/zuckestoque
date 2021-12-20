<?php 
	require_once 'connection.php';
	class Itens extends Connect
	{
		/*Função para cadastra Itens*/
		public function cadastraItens($dados)
		{
			try {
				if(is_array($dados)){

					$cadastra = $this->con->prepare("INSERT INTO itens VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?)");
					foreach($dados as $k => $v)
					{
						$cadastra->bindValue($k,$v);
					}
					$cadastra->execute();

					if($cadastra->rowCount()==1){
						
						header("location:../../views/?pg=itens/itens&m=1");
					}
				}

			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}
			
		}
		/*Função para atualizar os dados do itens*/
		public function atualizarItens($dados)
		{
			try {

				if(is_array($dados)){
					$idItem		= $dados["7"];
					$quant		= $dados["2"];
					$listar = $this->con->prepare("SELECT * FROM itens  WHERE idItem = ?");
					$listar->bindValue(1,$idItem);
					$listar->execute();
					if($listar->rowCount()==1){

						$dado = $listar->fetch(PDO::FETCH_ASSOC);
						$quantVendido		= 	$dado["QuantItensVendido"];
						$quantEstoque		= 	$quant		- $quantVendido;
					}
					array_pop($dados);
					array_push($dados,$quantEstoque);
					array_push($dados,$idItem);

					$atualizar  = $this->con->prepare("UPDATE itens SET Produto_idProduto = ?,QuantItens = ?,
							ValorCompraItem = ?,ValorVendaItem = ?,DataCompraItem = ?,DataVencimentoItem = ?,QItemEstoque=? WHERE idItem = ?
						");

					foreach($dados as $k => $v)
					{
						$atualizar->bindValue($k,$v);
					}

					$atualizar->execute();

					if($atualizar->rowCount() == 1){
						header("location:../../views/?pg=itens/itens&m=1");
					}else{
						header("location:../../views/?pg=itens/itens&m=0");
					}
				}
				

			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}
			
		}

		/*FNÇÃO PARA LISTAR OS ITENS*/
		public function listarItens($public)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM itens JOIN produto ON itens.Produto_idProduto = produto.idProduto JOIN marca ON marca.pro_idProduto = produto.idProduto WHERE itens_ativo = ?");
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
				echo "Erro ".$e->getMessage();
			}
		}
		/*FNÇÃO PARA RETORNAR OS DADOS DO ITENS PARA SER EDITADTO*/
		public function buscaDadosItens($idItens)
		{
				$ativo = 1;
			try {
				$listar = $this->con->prepare("SELECT * FROM itens JOIN produto ON itens.Produto_idProduto = produto.idProduto JOIN marca ON marca.pro_idProduto = produto.idProduto WHERE itens.idItem = ? AND  itens_ativo = ? ");
				 $listar->bindValue(1,$idItens);
				 $listar->bindValue(2,$ativo);
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
		/*FUNÇÃO PARA ATIVAR E DESATIVAR ITENS*/
		public function ativoItem($value,$id)
		{

			try {
				
				if($value == 1){
					$v = 0;
				}else{
					$v = 1;
				}

				$ativo = $this->con->prepare("UPDATE  itens SET itens_ativo = ? WHERE idItem = ? ");
				$ativo->bindValue(1,$v);
				$ativo->bindValue(2,$id);
				$ativo->execute();
				header("location:../../views?pg=itens/itens");
				
			} catch (Exception $e) {
				
			}
		}

		/*FNÇÃO PARA RETORNAR OS DADOS DO ITENS PARA SER REGISTADO NO CARRINHO*/
		public function pesquisaDadosItens($value)
		{
			try {
				$v = "%$value%";
				$ativo = 1;
				$listar = $this->con->prepare("SELECT * FROM produto,itens WHERE produto.NomeProduto LIKE ?  AND produto.idProduto = itens.Produto_idProduto AND itens.`itens_ativo` = ?");
				 $listar->bindValue(1,$v);
				 $listar->bindValue(2,$ativo);

				 $listar->execute();

				if($listar->rowCount()>0){
					$dados = array();
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					 $d = new arrayIterator($dados);
					 while ($d->valid()) {
				echo '<li>
			 			<span>'.$d->current()->idItem.'</span> - '
			 			.$d->current()->NomeProduto.' - '
			 			.$d->current()->Descricao.' - '
			 			.$d->current()->QItemEstoque.' - '
			 			.$d->current()->ValorVendaItem.'
					  </li>';
					 	$d->next();
					 }

				}else{

					echo "Sem dados";
				}
			} catch (Exception $e) {
				
			}
		}

		/*FNÇÃO PARA RETORNAR OS DADOS DO ITENS PARA SER REGISTADO NO CARRINHO*/
		public function buscaDadosItensVenda($value)
		{
			try {
				$ativo = 1;
				$listar = $this->con->prepare("SELECT * FROM produto,itens WHERE itens.idItem = ?  AND produto.idProduto = itens.Produto_idProduto AND itens.itens_ativo = ? ");
				 $listar->bindValue(1,$value);
				 $listar->bindValue(2,$ativo);
				 $listar->execute();

				if($listar->rowCount()==1){
					$dados = array();
					$dados = $listar->fetch(PDO::FETCH_ASSOC);
					return $dados;

				}else{

					return false;
				}
			} catch (Exception $e) {
				
			}
		}


		/*VERIFICA A QUANTIDADE NO ESTO QUE PARA SER VENDIDO*/

		public function verificaQuantItens($idItem,$quant)
		{
			$ativo = 1;
			try {
				$listar = $this->con->prepare("SELECT * FROM produto,itens WHERE itens.idItem = ?  AND produto.idProduto = itens.Produto_idProduto AND itens.itens_ativo = ?");
				$listar->bindValue(1,$idItem);
				$listar->bindValue(2,$ativo);
				$listar->execute();

				if($listar->rowCount()==1){
					$dados = array();
					$dados = $listar->fetch(PDO::FETCH_ASSOC);

					$quantE = $dados["QItemEstoque"];
					if($quantE>=$quant){
						return array("status"=>1);
					}else{
						//return array("status"=>0,"estoque"=>$quantE,"NomeProduto"=>$dados["NomeProduto"]);
						
						$_SESSION["msg"] = '

						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<span> &times;</span>
							</button>

							<span> <strong>OBS: </strong>a quantidade de <strong>'.$dados["NomeProduto"].'</strong> é maior do que em estoque<br/>
									Quantidade em estoque: <strong>'.$quantE.'</strong>
							</span>
						</div>
						';
						//header("location:../../views/?pg=venda/cadastro");
						unset($_SESSION["itens"][$idItem]);
						echo'<script>window.location.href="../../views?pg=venda/cadastro"</script>';
						exit();

					}

				}else{
					$_SESSION["msg"] = '

							<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert">
									<span> &times;</span>
								</button>

								<span> <strong>Erro: </strong> Código do produto <strong>'.$idItem.'</strong> inexistente</br>
								Verifique o id digite ou se o item esta ativo.
								</span>
							</div>
						';
						unset($_SESSION["itens"][$idItem]);
						echo'<script>window.location.href="../../views?pg=venda/cadastro"</script>';
						exit();
				}
			} catch (Exception $e) {
				
			}
		}
	}// Fim class de ITENS


 ?>