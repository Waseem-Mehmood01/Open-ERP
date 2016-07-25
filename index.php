<?php
session_start();
//echo "TestBranch";
// PHP Ledger Starting Point
require_once('functions.php');


$include_file = "";
$path ="";
if (isset($_GET['route'])) {
$path = $_GET['route'];
} else {
	if (isset($_POST['route'])) {
	$path = $_POST['route'];
	}
}
if($path <> "") { // Checks if file really exists before including it
	$include_file = "./".$path.".php";
	if(!file_exists($include_file)) {
		$include_file = "includes/page-parts/content-404.php";
	}
		
}

?>
<?php include_once('includes/page-parts/header.php');

if (isset($_GET['logout'])){
	if($_GET['logout'] == 1) {
		unset($_SESSION['is_logged']);
		unset($_SESSION['username']);
		//echo '<script>window.location.replace("./login_page.php");</script>';
		include_once('login_page.php');
	  
	}
}
 ?>
 
<?php if ( (isset($_SESSION['is_logged'])) AND ($_SESSION['is_logged'] == 1)) {
	$role_id = $_SESSION['role_id'] ;
?>
<?php include_once('includes/page-parts/top-nav.php'); ?>

<?php 
		if($include_file <> "") {
			include($include_file);
		}  else {			
		 include('includes/page-parts/content-default.php');  
		}

 ?>

<?php include_once('includes/page-parts/content-bottom.php'); ?>
<?php include_once('includes/page-parts/footer.php'); ?>
<?php 
} else { //if not logged in
	//echo '<script>window.location.replace("./login_page.php");</script>';
	include_once('login_page.php');
 }
?>
