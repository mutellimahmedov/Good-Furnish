<?php 
ob_start();

//Referans https://www.w3schools.com/php/php_mysql_connect.asp
$servername = "goodfurnishproject.mysql.database.azure.com";
$username = "muteahmedov";
$password = "dGJcJzp-6-SsgzC@";
try {
  $db = new PDO("mysql:host=$servername;dbname=new_schema", $username="muteahmedov", $password="dGJcJzp-6-SsgzC@");
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}