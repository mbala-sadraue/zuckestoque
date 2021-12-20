<?php 
	require 'auth.php';
	if($permissao) {
 		header("location:../views/");
 	}else{
 		header("location:../destroy.php");
 	} 

?>