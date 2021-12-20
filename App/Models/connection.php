<?php
 /*Conexão ao banco de dados*/

 abstract class Connect {

 	private $host = "localhost";
 	private $user = "root";
 	private $pass = "";
 	private $bd   = "control_estoque";
 	protected $con;

 	public function __construct()
 	{
 		try{

	 		$dns = "mysql:host=".$this->host.";dbname=".$this->bd;
	 		$sql = new PDO($dns,$this->user,$this->pass);

	 		$sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	 		$this->con = $sql;
	 	}catch(PDOException $e){
	 		
	 		if($e->getCode() == 2002){
	 			echo "O servidor esta desligado";
	 		}else{
	 			echo $e->getCode();
	 		}
	 	}
 		

 	}

 }

 

?>