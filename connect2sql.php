<?php
$user = "root";
$password = "ashwin92";
$db = "CorpSocNet";

// Connect to the mysql server
$conn = mysqli_connect("localhost",$user, $password, $db, 0, '/tmp/mysql.sock');
if (! $conn){
  die("Could not connect: "+ mysqli_error());
  echo "Connection could not be established";
} 
else{
    //echo "connection established <br>";
}
?>