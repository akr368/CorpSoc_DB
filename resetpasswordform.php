	

<html >
<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/Post.css">

	

  <body>
    <div class="header">
      <a class="left" HREF="home.php"> Home</a>
    <h1>Reset Password</h1>

    </div>
    
  
    <form action="updatepassword.php" method="POST">
    <div class="main-content">
  	<table>
    <form method="post">
    	<tr> <td rowspan=100%><img src="logo.png" alt="logo" style="width:200;height:auto;float:right;"></td></tr>

    	<tr><td>Username: </td><td><input type="text"  name="username" required="required" /></td></tr>
        <tr><td>Old Password:</td><td> <input type="password"  name="password1" required="required" /></td></tr>
        <tr><td>New Password: </td><td> <input type="password"  name="password2" required="required" /></td></tr>
        <tr><td>Confirm Password:</td><td> <input type="password"  name="password3" required="required" /></td></tr>
        <tr><td><input type="submit" name="submit" class="btn" value="Update Password"  /></td></tr>
    </form>
<tr>
    <?php
        session_start();
        
        if(isset($_SESSION['message2'])){
          echo $_SESSION['message2'];
          unset($_SESSION['message2']);
        }
?></tr>
</table>
</div>



</body>
</html>


