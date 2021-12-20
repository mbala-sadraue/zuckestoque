$(function(){
/*VALIDAR O FORMULÁRIO DE LOGIN */
 var input_Login = $("#caixa_formulario input");

 $(input_Login[0]).keyup(function(){
 	var v= $(this).val();
 	if(!v.trim()){
 		$(this).val("");
 	}
 })
	var input_form = $("#form_cadastra input");

	$(input_form).each(function(){
		$(this).keyup(function(){
			var input_val = $(this).val();
			if(!input_val.trim()){
				$(this).val("");
			}
		})
	})

	$("#btn_cadastra").click(function(){
		 
		for(let i = 0; i<input_form.length; i++){
			input_val = $(input_form[i]).val()

			
		}
		if (!input_val.trim()){
			alert("todos os campos são obrigatório")
		}


	})


})


//https://free.facebook.com/messages/read/?tid=cid.c.100011894236800%3A100022636929895&last_message_timestamp=1520277164543&pagination_direction=1&show_delete_message_button&refid=12
//https://free.facebook.com/photo.php?fbid=225825362211265&id=100043514080070&set=a.105026187624517
//https://free.facebook.com/yang.yeng.7967?rc=p&__tn__=R  Príscila Dos Santos
//Josimar F. Mateus