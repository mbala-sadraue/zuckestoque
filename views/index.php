<?php 
	require '../config/auth.php';
	if (isset($_GET["pg"])) {
		$file = $_GET["pg"];
		if (file_exists("$file.php")){
			require_once ''.$file.'.php';
		}else{
			require_once 'home.php';
		}
		
	} else{
		require_once 'home.php';
	}
	

 ?>