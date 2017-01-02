<?php
include("connect2sql.php");
session_start();    

//echo $_SESSION['user'];
//echo $_POST['postId'];

$currentUser = $_SESSION['username'];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$sql_likes = ("INSERT INTO Post_Likes(Post_post_id, username) VALUES ('$request->pid','$currentUser')");
if(mysqli_query($conn,$sql_likes)){
    echo "user has liked.";
}
else{
    echo mysqli_error($conn);
} 
?>