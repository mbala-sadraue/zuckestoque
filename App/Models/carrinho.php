<?php 
	session_start();
	if(isset($_POST["buscaProduto"]) && $_POST["buscaProduto"] == "buscaProduto" && $_POST["idItem"]>0 && $_POST["quantProduto"]> 0){

		if (!isset($_SESSION["itens"])) {
			$_SESSION["itens"] = array();
		}

		$idItem		= $_POST["idItem"];
		$qtd		= $_POST["quantProduto"];

		

		

		if(isset($_SESSION["itens"][$idItem])){
			$_SESSION["itens"][$idItem] = $qtd;
		}else{
			$_SESSION["itens"][$idItem] = $qtd;
		}	


		$contS = (isset($_SESSION["itens"]))? count($_SESSION["itens"]):0;

		if($contS==0){
			echo "Carrinho Vazio";
		}else{
			require 'itens.class.php';
			$itens = new Itens();

			$itens->verificaQuantItens($idItem,$qtd);

			

			$count = 1;
			$Total = 0;
			foreach ($_SESSION["itens"] as $idProduto => $quantidade) {
				$dados = $itens->buscaDadosItens($idProduto);
				if($dados){

						$dado = new arrayIterator($dados);
					while ($dado->valid()) {
						$idItem	 		= $dado->current()->idItem;
						$NomeProduto	= $dado->current()->NomeProduto;
						$Descricao		= $dado->current()->Descricao;
						$Marca 			= $dado->current()->NomeMarca;
						$Preco 			= $dado->current()->ValorVendaItem;
						$quantEsoque 	= $dado->current()->QItemEstoque;
						$dado->next();
					}
						$subTotal 		= $Preco * $quantidade; 
						$Total 			+= $subTotal;
					
			echo'

					<tr class="tr-tbody tr-venda">
						<td>'.$count.'</td>
						<td>'.$idItem.'
							<input type="hidden" name="id_Item['.$idProduto.']" value="'.$idProduto.'" />
						</td>
						<td>'.$NomeProduto.'</td>
						<td>'.$Descricao.'</td>	
						<td>'.$Marca.'</td>	
						<td>'.number_format($Preco,2,",",".").'
							<input type="hidden" name="preco_Item['.$idProduto.']" value="'.$Preco.'" />
						</td>	
						<td>'.$quantidade.'
							<input type="hidden" name="quant_Item['.$idProduto.']" value="'.$quantidade.'" />
						</td>	
						<td>'.number_format($subTotal,2,",",".").'</td>
						<td>
						<a href="../App/Database/remove.php?ac=removeItem&idProduto='.$idProduto.'" class="glyphicon glyphicon-trash"></a>
						</td>		
					</tr>

				';
					$count ++;

				}

				
			}

			echo '<tr>
					<td colspan="7">Total</td>
					<td colspan="">'.number_format($Total,2,",",".").'
						<input type="hidden" name="total" value="'.$Total.'" />
					</td>
					<td></td>
				</tr>';

		}


	}else{
		unset($_SESSION["itens"]["idProduto"]);
	}

?>