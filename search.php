<!DOCTYPE hmtl>


<head>
<link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/Post.css">
</head>
<body>
<div class = "header">
    <a class="left" HREF="home_feed.phtml"> Home</a>
<h1>My Connections</h1>
</div>

    <div class= "main-content">
<table>
<?php

session_start();

include("connect2sql.php");


if (isset($_POST['submit'])) {
  if(isset($_POST['search1'])){
    if($_POST['search1']=='Friends'){
        $loggedin = $_SESSION['username'];
        $search_txt = $_POST['search'];
        
       // echo "friends";
    $sql_friend = "SELECT username, First_Name, Last_Name, Display FROM PROFILE WHERE ( First_Name LIKE '%$search_txt%' OR Last_Name LIKE '%$search_txt%') AND username!='$loggedin' ";
    $result = mysqli_query($conn, $sql_friend);
    if(!$result){
        echo "No results...";
    }    
    else{
        while ($row = mysqli_fetch_array($result)){
            $name = $row[1].' '.$row[2];
            echo "<tr class = 'main-content'> <td>";
            echo "<a href = 'profiles.php?id=$row[0]'> $name </a> <td><br>";
            echo"<td> <img src='$row[3]' width='70px' height='70px'> ";
                echo "</td> </tr>";
            
        }
    }
    }
    else{
        $loggedin = $_SESSION['username'];
        $search_txt = $_POST['search'];
        header("location: post_result.php?search=$search_txt");
    }  
  }
}

?>
    </table> </div>
</body>