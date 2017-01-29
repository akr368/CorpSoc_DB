<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/Profile.css">
</head>
 

<?php
session_start();
include('connect2sql.php');
$username1=$_SESSION['username'];
//echo $username1;

$sql="SELECT * from Profile where username='$username1'";
    
$sql_result = mysqli_query($conn,$sql);

if (!$sql_result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$values = mysqli_fetch_array($sql_result);


if (mysqli_num_rows($sql_result) > 0) {

  
   $_SESSION['f_name']=$values[1];
   $_SESSION['s_name']=$values[2];
   $_SESSION['dept_id1']=$values[3];
   $_SESSION['position']=$values[4];
   $_SESSION['email_id1']=$values[6];
   $_SESSION['dob']=$values[7];
   $_SESSION['location']=$values[8];
  // echo "Read success...";

}

//echo $_SESSION['user'];

?>
<head>
    <title>Update User Profile</title>
</head>
    <body>

        <div class="header">
            <a class="left" HREF="home_feed.phtml"> Home</a>
<h1 class= "registration">Update Profile</h1>

</div>

<br><br>
        <div class="main-content">
        <table >
            <form method = "POST" action="updateprofile2.php"  enctype='multipart/form-data' >
                
                <tr>
                    <td>First Name:</td> <td><input type = "text" value="<?php echo $_SESSION['f_name']?>" name = "first_name" required > </td>
                </tr>
                <tr>
                    <td>Last Name:</td> <td><input type = "text" value="<?php echo $_SESSION['s_name']?>" name = "last_name" required> </td>
                </tr>
                <tr>
                    <td>Date of birth: </td>
                    <td><input type = "date" name ="dob" value="<?php echo $_SESSION['dob']?>">
                    </td>
                </tr>
                <tr>
                    <td>Position: </td>
                    <td><input type="text" name = "position" value="<?php echo $_SESSION['position']?>" required></td>
                </tr>
                <tr>
                    <td>Email id:</td> <td><input type = "email" value="<?php echo $_SESSION['email_id1']?>" name = "email" > </td>
                </tr>
                <tr>
                    <td>Enter Location:</td>
                <td>

                    <?php

                    
                    $sql="Select location_name from locations ";
                    $result=mysqli_query($conn,$sql);
//$result = mysql_query($sql);

                    //echo "Error: \n". mysqli_error($conn);
                    ?>

<select name="sub2"> 
<?php 
while($row = mysqli_fetch_array($result)){ 
echo '<option value="' .$row['location_name']. '">'. $row['location_name']. '</option>' ; 
} 
?> 

</td>
                </tr>
                <tr><td>Update Display Picture:</td>
                    <td><input type = "file" accept="image/jpeg" name="display_pic" ></td>
                    
                </tr>
        <tr>
            <td><input type = "Submit" value = "Update Profile" class ="btn">
            </td>
        </tr>
            </form>
        </table>
    </div>
    </body>    
    
</html>