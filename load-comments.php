<?php
session_start();

include("connect2sql.php");

$_SESSION['user'] = 'qwerty';
$currentUser = $_SESSION['user'];

$post = $_GET['pid'];

$sql_query = "SELECT * FROM comment WHERE post_id = '$post' ORDER BY cmtTime";

$comments = mysqli_query($conn, $sql_query);

if (!$comments){
    echo "no comments";
}

else{
    $outp = "";
    while($row = mysqli_fetch_array($comments)){
        if($outp !=""){ $outp .=",";}
        $outp .='{"cmtBy": "'    .$row["cmtby"]      .   '",';
        $outp .='"Content": "'   .$row["content"]    .   '",';
        $outp .='"PostId": "'    .$row["post_id"]     .   '"}';
    }
    
    $outp = '{"comments":['.$outp.']}';
    echo ($outp);
    
    //echo "comments loaded";
}
?>