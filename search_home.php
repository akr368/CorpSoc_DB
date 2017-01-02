<?php
session_start();
?>
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