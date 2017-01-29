<?php

session_start();
include ('connect2sql.php');

//echo 'Login user..' ."<br>";
//echo $_SESSION['emp_id'] ."<br>";
$user_1=$_SESSION['emp_id'];
//echo 'adsda';
//echo 'Send User id..' ."<br>";

$user_2=$_SESSION['login_emp_id'];

 //echo $_SESSION['login_emp_id'];

 $new_row = "INSERT INTO connections(user_1,user_2,action_time,action_user,status) VALUES 
 ('$user_1', '$user_2',now(),'$user_1',2)";
            
            if (mysqli_query($conn,$new_row)){
                echo 'Sent';
                header('Location: home_feed.phtml');
              }
              else{
              	echo mysqli_error($conn);
              }


?>