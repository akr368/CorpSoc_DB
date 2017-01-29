<?php

session_start();
include ('connect2sql.php');

$username1=$_POST['username'];
$password1= $_POST['password1'];
$password2= $_POST['password2'];
$password3= $_POST['password3'];

$sql="SELECT * from User where username='$username1' AND password='$password1'";
$sql_result = mysqli_query($conn,$sql);
$values = mysqli_fetch_array($sql_result);

if($username1==$values[0] AND $password1==$values[1]){
	if($password2==$password3){
$sql="UPDATE User SET  password='$password2' where username='$username1'";
$sql_result = mysqli_query($conn,$sql);
header("location:home.php");

  }
}

else{
	$_SESSION['message2']='Please try again';
	header("location:resetpasswordform.php");
}






?>