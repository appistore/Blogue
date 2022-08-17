<?php 
 // information pour la connection à le DB locale
//=========================================
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'blogue-db';
$link = mysqli_connect($host,$user,$pass,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>