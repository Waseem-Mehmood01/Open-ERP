<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
if(session_id() == '') {
    session_start();
}  


$username = "root";
$password = "";
$hostname = "localhost"; 
$dbName = "asia_traders";

define('REDHARE_ID', '1');
define('ANCHANTO_ID', '2');

DB::$user = $username;
DB::$password = $password;
DB::$dbName = $dbName;
DB::$host = $hostname; //defaults to localhost if omitted


//connection to the database
$con = mysqli_connect($hostname,$username,$password,$dbName);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
