
<?php
require 'config/auth.php';
if(isset($permissao) && $permissao != null){
 header('location:config/control.php');

}else{
	header('location:config/control.php');
}
