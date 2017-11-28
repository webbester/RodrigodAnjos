<?php
$servername = "127.0.0.1:3307";
$dbname = "transacoes";
$dbusername = "root";
$dbpassword = "";

try
{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$dbusername,$dbpassword,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e)
{
	$error = $e->getMessage();
	echo $error;
}



?>