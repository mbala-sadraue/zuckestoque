<?php 
	
	require_once 'connection.php';

	class Venda extends Connect
	{
		/*Função para cadastra Venda*/
		public function cadastraVenda($idItem,$quant,$preco,$valor,$cliente,$cart,$idUser)
		{
			try {
				$listar = $this->con->prepare("SELECT * FROM itens  WHERE idItem = ?");
				$listar->bindValue(1,$idItem);
				$listar->execute();
				if($listar->rowCount()==1){

					$dados = $listar->fetch(PDO::FETCH_ASSOC);
					$quantComprado		= 	$dados["QuantItens"];
					$quantVendido		= 	$dados["QuantItensVendido"];
					$quantEstoque		= 	$dados["QItemEstoque"];
					$quantVendidoFV	= $quantVendido + $quant;
					if($quantEstoque>=$quant){
						$quantEstoqueF = $quantEstoque - $quant;
					/*REGISTRA NA TEBELA VENDA*/
					$cadastraVenda = $this->con->prepare("INSERT INTO venda (idVenda, IdItem, QuanItem, Preco, NomeCliente, cart, User_idUser) VALUES (DEFAULT,?,?,?,?,?,?)");
					$cadastraVenda->bindValue(1,$idItem);
					$cadastraVenda->bindValue(2,$quant);
					$cadastraVenda->bindValue(3,$preco);
					$cadastraVenda->bindValue(4,$cliente);
					$cadastraVenda->bindValue(5,$cart);
					$cadastraVenda->bindValue(6,$idUser);
					$cadastraVenda->execute();

					if($cadastraVenda->rowCount()==1){
						$atualizaItenm =  $this->con->prepare("UPDATE itens SET QuantItensVendido = ?, QItemEstoque = ? WHERE idItem = ?");
						$atualizaItenm->bindValue(1,$quantVendidoFV);
						$atualizaItenm->bindValue(2,$quantEstoqueF);
						$atualizaItenm->bindValue(3,$idItem);
						$atualizaItenm->execute();
						if($atualizaItenm->rowCount() ==1){
							session_start();
							$_SESSION["msg"] = '

							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<span> &times;</span>
								</button>

								<span> <strong>Sucesso: </strong>venda efectuada com sucesso<br/>
									 <strong><a href="?pg=venda/venda">comfirmar</a></strong> a venda
								</span>
							</div>
							';
							$_SESSION["venda"] ='sucesso'; 
						//header("location:../../views/?pg=venda/cadastro");
						echo'<script>window.location.href="../../views?pg=venda/cadastro"</script>';

						}
					}	
				}
			}

			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}
			
		}
		/*BUSCA AS VENDA PELO ID DO ITEM*/
		public function buscaVendaPeloIdItem($idItem,$data){
			try {
				$valorData	= "%$data%";
				$listar = $this->con->prepare("SELECT * FROM venda INNER JOIN itens ON venda.IdItem = itens.idItem JOIN produto ON produto.idProduto = itens.Produto_idProduto JOIN marca ON marca.pro_idProduto = produto.idProduto  WHERE venda.IdItem = ? AND  venda.DataVenda LIKE ?");
				$listar->bindValue(1,$idItem);
				$listar->bindValue(2,$valorData);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					$d 	= new arrayIterator($dados);
					$quantVendida 	= 	0;
					$valorTotal 	= 	0;
					$total 			=	0;
					while ($d->valid()) {
						$idVenda		= 	$d->current()->idVenda; 
						$iditem 		= 	$d->current()->IdItem;
						$nomeProduto 	= 	$d->current()->NomeProduto;
						$Descricao		=	$d->current()->Descricao;
						$Marca 			= 	$d->current()->NomeMarca;
						$quantVendida 	= 	$quantVendida + $d->current()->QuanItem;
						$valorTotal		= 	$quantVendida * $d->current()->Preco;

						$d->next();
					}
					return array("NomeProduto"=>$nomeProduto,"Descricao"=>$Descricao,"Marca"=>$Marca,"QuantVendida"=>$quantVendida,"valorTotal"=>$valorTotal,"idVenda"=>$idVenda);
				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}

		}

		/*BUSCA AS VENDA PELO CART */
		public function buscaVendaPelaCart($cart,$data){
			try {
				$valorData	= "%$data%";
				$listar = $this->con->prepare("SELECT * FROM venda INNER JOIN itens ON venda.IdItem = itens.idItem JOIN produto ON produto.idProduto = itens.Produto_idProduto JOIN marca ON marca.pro_idProduto = produto.idProduto JOIN usuario ON usuario.idUsuario = venda.User_idUser  WHERE venda.cart = ? AND  venda.DataVenda LIKE ?  ");
				$listar->bindValue(1,$cart);
				$listar->bindValue(2,$valorData);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					$d 	= new arrayIterator($dados);
					$quantVendida 	= 	0;
					$subTotal 	= 	0;
					$total 			=	0;
					while ($d->valid()) {
						$q =  $d->current()->QuanItem;
						$preco =  $d->current()->Preco;
						$subTotal = $q * $preco;
						$nomeUsuario = $d->current()->NomeUsuario;
				echo'
						<tr>
							<td>'.$d->current()->IdItem.'</td>
							<td>'.$d->current()->NomeProduto.'</td>
							<td>'.$d->current()->Descricao.'</td>
							<td>'.$d->current()->NomeMarca.'</td>
							<td>'.$q.'</td>
							<td>'.number_format($subTotal,2,",",".").'</td>
						</tr>';
							$total += $subTotal;
						$d->next();
					}
					echo'<tr>
							<td colspan="5" >
								<strong>Oper:</strong>'.$nomeUsuario.'
							</td>
							<td >
								<strong>Total:'.number_format($total,2,",",".").'</strong>
							</td>
					</tr>';
					
				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}

		}

		/*FUNÇÃO QUE RETORNA A DATA DA VENDA DE ITENS*/
		public function buscaDataVenda($cart,$nomeCliente){
			try {
				$listar = $this->con->prepare("SELECT DISTINCT DataVenda FROM venda WHERE cart = ? AND NomeCliente = ?");
				$listar->bindValue(1,$cart);
				$listar->bindValue(2,$nomeCliente);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetch(PDO::FETCH_ASSOC);
					return $dados["DataVenda"];
					
				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}

		}

		public function eliminaRegistroVenda($cart){
			$ativo  = 0;
			$delete = $this->con->prepare("UPDATE venda SET vendaAtivo = ? WHERE cart = ?");
			$delete->bindValue(1,$ativo);
			$delete->bindValue(2,$cart);
			$delete->execute();
			if($delete->rowCount() > 0 ){
				session_start();

				$_SESSION["msg"] = '

					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">
							<span>&times;</span>
						</button>
						<span><strong>Sucesso:</strong> Registro eliminado com sucesso!</span>

					</div>


				';
			}else{
				session_start();
				$_SESSION["msg"] = '

					<div class="alert alert-danger">

							<button class="close" data-dismiss="alert">
								<span>&times</span>
							</button>

							<span> <strong>Erro: <strong> Erro ao eliminar Registro da venda</span>
					</div>
				';
			}
			echo'<script>window.location.href="../../views?pg=venda/venda"</script>';
		}
		
	}// Fim class da Venda

 ?>