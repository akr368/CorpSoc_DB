
<html>
<head>
<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/Post.css">
</head>
<body>
    <body>
    <div class="header">
      <a class="left" HREF="home_feed.phtml"> Home </a>
    <h1>Notifications</h1>

    </div>
<?php
session_start();

include('connect2sql.php');
$username1=$_SESSION['username'];

$date = new DateTime("now", new DateTimeZone('America/New_York') );
$date->format('Y-m-d H:i:s');

$sql1="SELECT emp_id from User where username='$username1'";
    
$sql_result1 = mysqli_query($conn,$sql1);

if (!$sql_result1) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$values1 = mysqli_fetch_array($sql_result1);
$emp_id=$values1[0];

$sql5="SELECT * FROM connections where status=2 AND (user_1=$emp_id OR  user_2=$emp_id ) ";
$sql_result=mysqli_query($conn,$sql5);   

if(mysqli_num_rows($sql_result)>0){

while($row1 = mysqli_fetch_assoc($sql_result)){ 



if($row1['action_time']>$_SESSION['save_login'] && $row1['action_time']< $date){
        
 if($row1['action_user']!=$emp_id){


    $user_1=$row1["user_1"];
        $user_2=$row1['action_user'];
        $_SESSION['login_emp_id']=$row1['action_user'];


 $sql2="SELECT username from user where emp_id='$user_2'";
 $sql_result2 = $conn->query($sql2);
$sql_item1 = mysqli_fetch_array($sql_result2);  
$username_1= $sql_item1[0];


$sql3="SELECT First_Name,Last_Name from Profile where username='$username_1'";
$sql_result3= $conn->query($sql3);
$sql_item2 = mysqli_fetch_array($sql_result3);  
$full_name=$sql_item2[0]." ".$sql_item2[1]." sent you a friend request";

echo " <table >
        <tr>
        <td>".$full_name ."<br></td>
        <td>
        <form method='post' action='accept.php'>
         <input class='btn' type='submit'  value='Accept Friend Request'/>
         </form></td>";


echo "<td><form method='post' action='reject.php'>
         <input class='btn' type='submit' name='delete' value='Reject Friend Request'/>
         </form></td>";


echo "</tr></table>";

}
}

}
}
else{
  echo "<span style='padding-left:30px;fontsize:14'>No New Notifications. <span>";
}

 
//Status-3

/*

$sql5="SELECT * FROM connections where status=3 AND (user_1=$emp_id OR  user_2=$emp_id ) ";
$sql_result=mysqli_query($conn,$sql5);   

while($row1 = mysqli_fetch_assoc($sql_result)){ 

if($row1['action_time']>$_SESSION['save_login'] && $row1['action_time']< $date){

  //echo "Test" ."<br>";
//echo "ABCD......" ."<br";

        
 if($row1['action_user']!=$emp_id){

//echo "Test11" ."<br>";

    $user_1=$row1["user_1"];
        $user_2=$row1['action_user'];
        $_SESSION['login_emp_id']=$row1['action_user'];
     //   echo $user_1 ." " .$user_2 ."<br>";

 $sql2="SELECT username from user where emp_id='$user_2'";
 $sql_result2 = $conn->query($sql2);
$sql_item1 = mysqli_fetch_array($sql_result2);  
$username_1= $sql_item1[0];
//echo $username_1 ."<br>";

$sql3="SELECT First_Name,Last_Name from Profile where username='$username_1'";
$sql_result3= $conn->query($sql3);
$sql_item2 = mysqli_fetch_array($sql_result3);  
$full_name=$sql_item2[0]." ".$sql_item2[1]." rejected your friend request";

echo $full_name ."<br>";

}

  else{
    echo 'NO'."<br>";;
  }
}

}

*/


?>

</body></html>