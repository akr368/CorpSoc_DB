<?php

session_start();
include ('connect2sql.php');

echo 'Login user..' ."<br>";
echo $_SESSION['emp_id'] ."<br>";
$user_1=$_SESSION['emp_id'];
echo 'adsda';
echo 'Send User id..' ."<br>";

$user_2=$_SESSION['login_emp_id'];

 echo $_SESSION['login_emp_id'];




$sql1="DELETE from connections where status='2' AND user_1='$user_1' AND user_2='$user_2'";

if(mysqli_query($conn,$sql1)) {
   // echo "Accepted Friend Request1";
    header("location:home_feed.phtml");
} else{
	 mysqli_error($conn);
}


$sql2="DELETE from Connections where status='2' AND user_1='$user_2' AND user_2='$user_1'";

if(mysqli_query($conn,$sql2)) {
   // echo "Accepted Friend Request";
    header("location:home_feed.phtml");
} 




?>