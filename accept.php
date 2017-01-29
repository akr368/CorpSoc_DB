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




$sql_profile="UPDATE Connections SET status='1' where user_1='$user_1' AND user_2='$user_2'" ; 

if(mysqli_query($conn,$sql_profile)) {
    echo "Accepted Friend Request1";
    header("location:home_feed.phtml");
} 

$sql_profile="UPDATE Connections SET status='1' where user_1='$user_2' AND user_2='$user_1'" ; 

if(mysqli_query($conn,$sql_profile)) {
    echo "Accepted Friend Request";
    header("location:home_feed.phtml");
} 


?>