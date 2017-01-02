<html>
    <head>
    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/Post.css">
    </head>
    <body>
        
        <div class = "header">
        	<a class="left" HREF="home_feed.phtml"> Home</a>
     <a class="left" HREF="update_profile.php">Profile</a> 
<a class="left" HREF="notifications.php"> Notifications </a>
            <h1>Connections</h1>
            
  <a class="right" href="logout.php">Logout</a>
    </div>
        
        <div class = "main-content">
            
        <table>
<?php

session_start();

include("connect2sql.php");

$username = $_SESSION['username'];   
$sql1="SELECT emp_id from User where username='$username'";
    
$sql_result1 = mysqli_query($conn,$sql1);

if (!$sql_result1) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$values1 = mysqli_fetch_array($sql_result1);
$emp_id=$values1[0];

            
$sql_friends ="SELECT p.username, First_Name, Last_Name,Display
            FROM
                User U JOIN PROFILE p on p.username = U.username
            WHERE
                U.emp_id IN (SELECT 
                        user_1 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_2 = '$emp_id' UNION SELECT 
                        user_2 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_1 = '$emp_id')";

$result = mysqli_query($conn, $sql_friends);
if($result){
  //  echo "connected";
    while($row = mysqli_fetch_array($result)){
    	//echo "check1";
        
        echo  "<tr><td><a href = 'profiles.php?id=$row[0]'>".$row[1]." ".$row[2]."</a></td></tr>";
        echo"<td> <img src='$row[3]' width='70px' height='70px'> ";
            }

}
else{
    echo mysqli_error($conn);
                }

    

?>
        </table>
    </div>
</body>
</html>