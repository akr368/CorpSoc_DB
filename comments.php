<?php
include("connect2sql.php");
session_start();
$currentUser = $_SESSION['username'];

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$sql_comment = "INSERT INTO COMMENT(post_id,cmtby,cmt_time,content) VALUES('$request->pid','$currentUser',now(),'$request->content')";
if (mysqli_query($conn, $sql_comment)){
    echo "comment added.";
}
else{
    echo mysqli_error($conn);
}

?>