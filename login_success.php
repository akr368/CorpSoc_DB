
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
     
   //$search_text=$_POST['search'];
   echo $_SESSION['username'] ."<br>";
   echo $_SESSION['emp_id'];

   $employee_id=$_SESSION['emp_id'];

$sql="SELECT * from Connections where user_1='$employee_id' OR user_2='$employee_id'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


$flag=1;
echo "CONNECTIONS"."<br>";

while($row = mysqli_fetch_assoc($result)){

    //echo "TEST" ."<br>";
        $user_1=$row["user_1"];
        $user_2=$row["user_2"];
       // echo $user_1;
       // echo $user_2;
       
if($user_1==$employee_id){

 //echo $user_2 ."<br>";
 $sql1="SELECT username from user where emp_id='$user_2'";
 $sql_result = $conn->query($sql1);
$sql_item = mysqli_fetch_array($sql_result);  
$username_1= $sql_item[0];
$sql2="SELECT First_Name,Last_Name from Profile where username='$username_1'";
$sql_result1 = $conn->query($sql2);
$sql_item1 = mysqli_fetch_array($sql_result1);  
$full_name=$sql_item1[0].$sql_item1[1];


echo $full_name ."<br>";


}

else{
 // echo $user_1 ."<br>";
  $sql1="SELECT username from user where emp_id='$user_1'";
 $sql_result = $conn->query($sql1);
$sql_item = mysqli_fetch_array($sql_result);  
$username_1= $sql_item[0];
$sql2="SELECT First_Name,Last_Name from Profile where username='$username_1'";
$sql_result1 = $conn->query($sql2);
$sql_item1 = mysqli_fetch_array($sql_result1);  
$full_name=$sql_item1[0].$sql_item1[1];

echo $full_name ."<br>";


}
}

?>

<!DOCTYPE html>
<html>

<body>

<h1>Search</h1>
<table>
<form name='search' method = "post" action = "search.php">

<tr>  
      <td> <input type="text" name="search" size="12" required/> </td> 
  </tr>

<tr>
     <td>    <input type="submit" name="submit" value="Submit" /> </td>
    </tr>
</form>
</table>
</body>

</html>