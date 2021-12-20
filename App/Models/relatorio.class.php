<?php 
	require_once 'connection.php';

	class Relatorio extends Connect
	{
		/*RELATÓRIO (SELECIONA OS ITENS VENDIDO DARIAMENTE)*/
		public function RelatorioDianio($data){
			try {
				$valorData	= "%$data%";
				$ativo = 1;
				$listar = $this->con->prepare("SELECT DISTINCT IdItem FROM venda WHERE DataVenda LIKE ? && vendaAtivo = ?");
				$listar->bindValue(1,$valorData);
				$listar->bindValue(2,$ativo);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;

				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}

		}

		/*RELATÓRIO (SELECIONA OS ITENS VENDIDO MENSALMENTE)*/
		public function RelatorioMensal($data){
			try {
				$valorData	= "%$data%";
				$ativo = 1;
				$listar = $this->con->prepare("SELECT DISTINCT IdItem FROM venda WHERE DataVenda LIKE ? && vendaAtivo = ?");
				$listar->bindValue(1,$valorData);
				$listar->bindValue(2,$ativo);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;

				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}

		}


		public function notaVendaDiario($data)
		 
		{
			try {
				$valorData	= "%$data%";
				$ativo = 1;
				$listar = $this->con->prepare("SELECT DISTINCT cart,NomeCliente FROM venda WHERE DataVenda LIKE ? && vendaAtivo = ? ORDER BY DataVenda DESC");
				$listar->bindValue(1,$valorData);
				$listar->bindValue(2,$ativo);
				$listar->execute();

				if($listar->rowCount()>0){
					$dados = $listar->fetchAll(PDO::FETCH_OBJ);
					return $dados;

				}else{
					return 0;
				}
			} catch (Exception $e) {
				echo "Erro ".$e->getMessage();
			}
		} 

	}// FIM DA CLASS RELATÓRIO


	/*CLASS QUE MOSTRA OS RELATOS SOLICITADOS*/
	class MostraRelatorio 
	{
		public function mostraRelatorioDiario($data)

		{

			$dataDiario 	 = $data;
			$relatorio 	= new Relatorio();

			$dados = $relatorio->RelatorioDianio($dataDiario);
			if($dados){
				$dado 	= new arrayIterator($dados);
				require_once"venda.class.php";
				$venda = new Venda();
				$totalDiario = 0;
				while ($dado->valid()) {
					$idItem 	= $dado->current()->IdItem;
					$r 	= 	$venda->buscaVendaPeloIdItem($idItem,$dataDiario);

					if($r){
						$idVenda = $r["idVenda"];
					
						echo'
							<tr>
								<td>'.$r["NomeProduto"].'</td>
								<td>'.$r["Descricao"].'</td>
								<td>'.$r["Marca"].'</td>
								<td>'.$r["QuantVendida"].'</td>
								<td>'.number_format($r["valorTotal"],2,",",".").'</td>';
								
								
					echo'	</tr>
						';
						$totalDiario = $totalDiario + $r["valorTotal"]; 
					}

					$dado->next();
				}
			echo'<tr style="background:green !important; color:#fff; font-weight:bold; ">
					<td colspan="4">Total</td>
					<td colspan="">'.number_format($totalDiario,2,",",".").'</td>
					';
						
				echo'<tr/>';
			}else{
				echo'<tr style="background:black !important; color:#fff; ">
					<td colspan="6">Sem registro da Venda  de hoje</td>
					<tr/>';
			}
		}

		public function mostraMensal()

		{
			
			$relatorio 			= new Relatorio();
			$dataMensal			= date("Y-m");
			$dados = $relatorio->RelatorioMensal($dataMensal);
			if($dados){

				$dado 	= new arrayIterator($dados);
				require_once"venda.class.php";
				$venda = new Venda();
				$totalDiario = 0;
				while ($dado->valid()) {
					$idItem 	= $dado->current()->IdItem;
					$r 	= 	$venda->buscaVendaPeloIdItem($idItem,$dataMensal);
					
					if($r){

					
						echo'
							<tr>
								<td>'.$r["NomeProduto"].'</td>
								<td>'.$r["Descricao"].'</td>
								<td>'.$r["Marca"].'</td>
								<td>'.$r["QuantVendida"].'</td>
								<td>'.number_format($r["valorTotal"],2,",",".").'</td>
							</tr>
						';
						$totalDiario = $totalDiario + $r["valorTotal"]; 
					}

					$dado->next();
				}
			echo '<tr style="background:green; color:#fff; font-weight:bold; ">
					<td colspan="4">Total</td>
					<td colspan="">'.number_format($totalDiario,2,",",".").'</td>
				<tr/>';
			}else{
				echo'<tr style="background:black !important; color:#fff; ">
					<td colspan="5">Sem registro da Venda neste mês</td>
					<tr/>';
			}
		}

		/*MOSTRA NOTA DE VENDA DIÁRIO*/
		public function mostraNotaVendaDiario()

		{
			require_once"venda.class.php";
			$venda = new Venda();
			$relatorio 			= new Relatorio();
			$dataDiario			= "2021-07";//date("Y-m-d");
			$dados = $relatorio->notaVendaDiario($dataDiario);
			if($dados){

				$dado = new arrayIterator($dados);
				while ($dado->valid()) {
					

					$cart =  $dado->current()->cart;
					$NomeCliente	= $dado->current()->NomeCliente;
					$DataVenda 		= $venda->buscaDataVenda($cart,$NomeCliente);
					$Data 			= date("d-m-Y",strtotime($DataVenda));
					$Hora 			= date("H-i-s",strtotime($DataVenda));
					echo'
						<table class="table">
							<tbody>
								<tr>
									<td colspan="6">
										<div class="">
											<div class="col-sm-10">
												<strong>Cliente:</strong> '.$NomeCliente.' <br/>
												Data:'.$Data.'<br/>
												Hora:'.$Hora.'
											</div>
											<div class="col-sm-2 text-right">';
												if($_SESSION["dados"]["permissao"]==1){
									echo'
													
														<form method="post"action="venda/action.php">
														<input type="hidden" name="cart" value="'.$cart.'"/>
															<button class="glyphicon glyphicon-trash botao" name="acao" value="elimina"></button>
														</form>
														';
												}
								echo'</div>
										</div>
											
									</td>
								</tr>
								<tr>
	                              <td><strong>Cod.</strong></td>
	                              <td><strong>Produto</strong></td>
	                              <td><strong>Descrição</strong></td>
	                              <td><strong>Marca</strong></td>
	                              <td><strong>Qtde</strong></td>
	                              <td><strong>Valor Uni.</strong></td>
	                            </tr>';
	                            $venda->buscaVendaPelaCart($cart,$dataDiario);

							echo'</tbody>
						</table>
					';

					$dado->next();
				}
			}else{
				echo '<h2>Sem recibos</h2>';
			}

				
		}


	}
 ?>