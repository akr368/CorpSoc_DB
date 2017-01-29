<html>
<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/Post.css">
    
    </html>
<?php
session_start();

//echo $_SESSION['user'];

?>
<html>
<head><title>Create User Profile</title></head>
    <body>
        <div class="header">
            <a class="left" HREF="home.php"> Home</a>
<h1 class= "registration">Complete User Profile</h1>

</div>
<br>
<br><br>
        <div class="main-content">
        
            <form method = "POST" action="create_profile.php"  enctype="multipart/form-data" >
                <table>
               <tr> <td rowspan=100%><img src="logo.png" alt="logo" style="width:150px;height:auto;float:right;"></td></tr>

                <tr>
                    <td>First Name:</td> <td><input type = "text" name = "first_name" required > </td>
                </tr>
                <tr>
                    <td>Last Name:</td> <td><input type = "text" name = "last_name" required> </td>
                </tr>
                <tr>
                    <td>Date of birth: </td>
                    <td><input type = "date" name ="dob" min = "1950-01-01" max = "1998-12-31" required>
                    </td>
                </tr>
                <tr>
                    <td>Position: </td>
                    <td><input type="text" name = "position" required></td>
                </tr>
                <tr>
                    <td>Email id:</td> <td><input type = "email" name = "email" required > </td>
                </tr>
                <tr>
                    <td>Location: </td>
                    <td>

                    <?php

                     include('connect2sql.php');
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
</select> 

                    
                </tr>

                </tr>
                <tr>
                    <td>Choose Profile Picture: </td>
                    <td><input type = "file" accept="image/jpeg"  name="display_pic" ></td>
                    
                </tr>
        <tr>
    

            <td><input type = "Submit" value = "Create Profile" class ="btn">
            </td>
        </tr></table>
        <?php
        
        if(isset($_SESSION['message3'])){
          echo $_SESSION['message3'];
          unset($_SESSION['message3']);
        }

     ?>
            </form>
        
    </div>
    </body>    
    
</html>



