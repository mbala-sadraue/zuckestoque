
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Página Inicial</title>
	<meta name="author" content="Mbala Sadraque"/>
	<meta name="viewport" content="width=width-device, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/estilo.css" />
</head>

<?php 
 date_default_timezone_set("Etc/GMT-1");
 $horas	= date("H");
 if($horas>=0 && $horas < 12){
 	$comprimeto = "Bom Dia";
 }elseif($horas >=12 && $horas < 18){
 	$comprimeto = "Boa Tarde";
 }else{
 	$comprimeto = "Boa Noite";
 }
require_once '../layout/layout.php';
echo $header;
?>
	<div class="home">
		<div class="container ">
		<!--<div><h1>Pagina Inicial</h1></div>--->
		<div class="col-sm-6">
			<h1 class="title">Pagina Inicial</h1>
		</div>
		<div class="col-sm-6 text-center"><h2 class="title-2 h2"><?php echo $comprimeto; ?></h2></div>
	</div>
	</div>
	
	<div class="container">
		
		<?php 

			echo "Permissão $permissao";
		 ?>
		</div>
	</div>


<?php
echo $footer;


?>