<!DOCTYPE html>

<html>
<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/Post.css">
   

<head>
    <title>Registration</title>

</head>

<body>
 <div class="header">
 <a class="left" HREF="home.php"> Home</a>
<h1 class= "registration">Registration Form</h1>

</div>

<br><br>

  <div class="main-content">
    <table>
<form name='registration' method = "post" action = "registration.php">
<tr> <td rowspan=100%><img src="logo.png" alt="logo" style="width:150px;height:150;float:right;"></td></tr>
<tr>    <td>

           <label for="userid">Enter Username:</label> </td>

      <td>      <input type="text" name="username" size="12" required/>

    </td> </tr>


<tr>        <td>

            <label for="pass">Password:</label> </td>

        <td>    <input type="password" name="passid" size="12" required />

        </td>

    </tr>     

<tr>       <td>     <label for="empid">Employee id:</label>
    </td>
        <td>    <input type="text" name="emp_id" size="50" required />
    </td>
    
    </tr>
        

        <tr>

         <td>   <label for="empid">Dept id:</label>
            </td>
            <td>
            <?php

                     include('connect2sql.php');
                    $sql="Select Department_name from Department ";
                    $result=mysqli_query($conn,$sql);
//$result = mysql_query($sql);

                    //echo "Error: \n". mysqli_error($conn);
                    ?>

<select name="sub1"> 
<?php 
while($row = mysqli_fetch_array($result)){ 
echo '<option value="' .$row['Department_name']. '">'. $row['Department_name']. '</option>' ; 
} 
?> 

            
            </td>
        </tr>
        <tr>
            <td>
            <label>Project Code (if applicable):</label></td>
      <td>      <input type = "text" name="proj_code" required/> </td>
        </tr>
 <tr>
     <td>    <input type="submit" class="btn" name="submit" value="Register" /> </td>
    </tr>
    
    <?php
        session_start();   
        if(isset($_SESSION['message1'])){
          echo $_SESSION['message1'];
          unset($_SESSION['message1']);
        }

     ?>
</form>
</div>
</table>
</body>


</html>