<?php

session_start();
    $username="root";
    $password="ashwin92";
    $db="CorpSocNet";

    $conn=mysqli_connect("localhost",$username,$password,$db,0,'/tmp/mysql.sock');

    if(!$conn){
        die("Could not connect: " + mysqli_error($conn));
        echo "Connection Failed";
    }
    else {
        echo 'Connection sucessful!';
    }

    $username1=$_POST['username'];
    $password2=$_POST['password'];
    

    //echo $username1 ."<br>";
   // echo $password2 ."<br>";

$sql="SELECT * from User where username='$username1' AND password='$password2'";
    
$sql_result = mysqli_query($conn,$sql);

if (!$sql_result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$values = mysqli_fetch_array($sql_result);

if (mysqli_num_rows($sql_result) > 0) {

    $_SESSION['emp_id']=$values[1];

$sql_savelogin="SELECT last_login from user  where  username='$username1'" ; 
$sql_run1=mysqli_query($conn,$sql_savelogin);

$values = mysqli_fetch_array($sql_run1);
$_SESSION['save_login']=$values[0];


$sql_lastlogin="UPDATE USER SET last_login=NOW() where  username='$username1'";
 
if(mysqli_query($conn,$sql_lastlogin)) {
    echo "Login updated successfully";
    
} 
mysqli_error($conn);

$_SESSION['username']=$username1;
echo $_SESSION['emp_id'];
header("location:home_feed.phtml");  //Change
echo "User exists";

}

else{

    $_SESSION['message']='Please try again.';
echo "<div>222</div>";
header("location:home.php");
echo "11";



} 


?>