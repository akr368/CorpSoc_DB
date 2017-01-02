<?php
include("connect2sql.php");
session_start();

//echo $_SESSION['user'];

$loggedin = $_SESSION['username'];
$search_txt = $_GET['search'];
$sql_search = "SELECT 
    *
FROM
    (SELECT 
        *
    FROM
        Post P
    WHERE
        postBy IN (SELECT 
                username
            FROM
                User U
            WHERE
                U.emp_id IN (SELECT 
                        user_1 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_2 = '$loggedin' UNION SELECT 
                        user_2 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_1 = '$loggedin'))
            OR viz = 0) p
        LEFT JOIN
    post_attachment a ON p.post_id = a.parent_post_id 
WHERE p.content LIKE '%$search_txt%'";
    
    $result = mysqli_query($conn, $sql_search);
    $outp = "";
        while ($row = mysqli_fetch_array($result)){
        
        if($outp !=""){ $outp .=",";}
        $outp .='{"Title":"'    .$row["title"]      .   '",';
        $outp .='"Content":"'   .$row["content"]    .   '",';
        $outp .='"PostBy":"'    .$row["postBy"]     .   '",';
        $outp .='"PostId":"'    .$row["post_id"]     .   '",';
        $outp .='"attachment":"'    .$row["Att_ContentType"]     .   '",';
        $post = $row["post_id"];
        
        $sql_cmts = "SELECT * FROM comment WHERE post_id = '$post' ORDER BY cmt_time DESC";

        $comments = mysqli_query($conn, $sql_cmts);
        $cmt = "";
        while($row_2 = mysqli_fetch_array($comments)){
            if($cmt !=""){ $cmt .=",";}
            $cmt .='{"cmtBy": "'    .$row_2["cmtby"]      .   '",';
            $cmt .='"cmt_content": "'   .$row_2["content"]    .   '"}';
            }
        
    $outp.='"comments":['.$cmt.']';
    
        $sql_likes = "SELECT COUNT(*) FROM POST_LIKES WHERE Post_post_id = '$post'";
        
        $likes = mysqli_fetch_array(mysqli_query($conn,$sql_likes))[0];
        
   $outp .= ',"likes":"'.$likes.'"}';
}
    $outp = '{"records":['.$outp.']}';
    echo ($outp);   

?>