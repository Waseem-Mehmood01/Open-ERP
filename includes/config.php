<?php
 ini_set('display_errors',1); 
 date_default_timezone_set('Asia/Karachi');
error_reporting(E_ALL);
if(session_id() == '') {
    session_start();
//Load essential PHP Classes
}
  
// Define System CONSTANTS
define('SYSTEM_ENCODING', 'utf8' );
define('BR','</br>');
$now = date("Y-m-d H:i:s");

	
define('FOLDER_NAME','asia');
define('ROOT_PATH', realpath(dirname(__FILE__)."/../").'/');
define('SITE_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/'.FOLDER_NAME.'/');
define('DB_PREFIX', 'sa_');

// These are defined here to simulate logged in user behaviour. untill we have completed the security module, we will define all session variables here..

/*
	$_SESSION['is_logged'] = 1; 
	$_SESSION['company_id'] =1 ;
	$_SESSION['user_id'] =1;
	$_SESSION['user_name'] ='test';
	$_SESSION['role_id'] = 1;
	$_SESSION['co_prefix'] = "test_";
	$_SESSION['default_expense_account'] = 1; // get default Expense Account Company
	$_SESSION['DB_PREFIX'] = 'sa_';
 	$_SESSION['company_name'] = 'Asia Traders';
 
*/
	?>
