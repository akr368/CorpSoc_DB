

<html >
<body>

<head>
  <meta charset="UTF-8">
  
  <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/Post.css">

</head>

<body>

  <div class="header">
<h1 class= "registration">Log In</h1>

</div>

<br><br><br>
  	<form action="check.php" method="POST">
	
    <form method="post">
      
      <div class="main-content">
      <table>
        <tr><td rowspan=100%><img src="logo.png" alt="logo" style="width:auto;height:50;"></td></tr>
     <tr> <td><label for="uname">Username</label></td>
    	<td> <input type="text"  name="username" required="required" /></td><tr>
      <tr> <td><label for="password">Password</label><td>
      <input type="password"  name="password" required="required" /><td></tr>
      <tr> <td>  <input type="submit" class="btn" name="submit" value="SignIn"  /> </td></tr>
       <tr> <td><a HREF="registration_form.php">New User?Click here</a> </td></tr>
     
        
        <?php
        session_start();
        if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);

        }
      
     ?>

   
    <tr><td><a href="resetpasswordform.php"> Click here to reset password </a></td></tr>
     </table>
   </div>
     </form>
    
    </form>   

</body>
</html>
