<?php 
require('../functions.php');
if(isset($_POST['user'])){
$user = $_POST['user'];
}
if(isset($_POST['password'])){
$password = $_POST['password'];
}
if((isset($user)) AND (isset($password))){
	$company_id=1;
	$superadmin='';
	$check = attempt_login_user($user, $password, $company_id, $superadmin);
	if($check){
		echo '1';
	} else {
		echo '0';
	}
}
?>