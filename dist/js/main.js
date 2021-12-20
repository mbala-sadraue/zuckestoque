$(function(){
	
	/*ESCRIPT PARA COLAR AS LINAS DA  TABELAS*/

	var tr = $(".table-striped tbody > tr");
	for (var i = 0; i < tr.length; i++) {
		if(i % 2 == 0){
			$(tr[i]).addClass("b0");
		}

		$(tr[i]).addClass("bh");
	}
	
	/*CAMPO DE BUSCA DE PRODUTO NA TABELA ITEM*/

	$("#form_buscaProduto #searchProduto").keyup(function(){
		valueProduto = ($(this).val())
		if(valueProduto != 0){
			var busca = "busca"
			$.ajax({

				url:  	"../App/Database/search.php",
				method: "POST",
				data: 	{query:valueProduto,busca:busca},
				success : function(data){
					$("#respostaProduto").fadeIn();
					$("#respostaProduto").html(data)
				}
			})
		}else{
			$("#respostaProduto").html("Campo vazio")
		}
		
	})
	$("#respostaProduto").on("click","span",function(){
		$("#form_buscaProduto #searchProduto").val($(this).text())
		$("#respostaProduto").fadeOut();
	})


	/*REGISTRA OS DADOS NO CARRINHO*/
	$("#form_cadastra #registroProduto").click(function(){
		var idItem =  $("#form_cadastra  #idItem").val()
		var quantProduto		= $("#form_cadastra  #QProduto").val()
		
		if(idItem != 0){
			if(quantProduto > 0){
				var buscaProduto = "buscaProduto"
				$.ajax({
					url: 	"../App/Models/carrinho.php",
					method: "POST",
					data: 	{buscaProduto:buscaProduto,idItem:idItem,quantProduto:quantProduto},
					success:function(data){
						$("#carrinhoResposta").html(data)
					}	
				})
			}else{
				alert("Quantidade deve ser maior que zero")
			}
		}else{
			alert("O campo codigo do produto é obrigatório")
		}
		
	})

	/*ESTILO DE TABELA CARRINHO*/

	/*var tr = $(".table tbody > tr.venda");
	for (var i = 0; i < tr.length; i++) {
		if(i % 2 == 0){
			$(tr[i]).addClass("b0");
		}

		$(tr[i]).addClass("bh");
	}*/
	

	/*BUSCA RELATÓRIO DE VENDA */

	$("#btnBuscaRelatorio").click(function(){
		var valor = $("#dataRelatorio").val();
		if(valor != 0){
			window.location.href="?pg=venda/relatorio&op=relatorio&"+"data="+valor;
		}else{
			alert("Escolha uma data")
		}
		return false;
	})
	
})