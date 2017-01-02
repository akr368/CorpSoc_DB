<?php
session_start();
include ("connect2sql.php") ;

$usr = $_SESSION['username'];
//posts
$sql_fetch_posts = "SELECT * FROM
    (SELECT 
        *
    FROM
        Post pst
        
    WHERE
        pst.postBy IN (SELECT 
                username
            FROM
                User U
            WHERE
                U.emp_id IN (SELECT 
                        user_1 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_2 = '$usr' UNION SELECT 
                        user_2 AS friends
                    FROM
                        CONNECTIONS
                    WHERE
                        status = 1 AND user_1 = '$usr'))
            OR viz = 0 OR postby='$usr') p
        LEFT JOIN
    post_attachment a ON p.post_id = a.parent_post_id 
    LEFT JOIN locations l on l.locid = p.loc_id

ORDER BY postTime DESC";

$posts = mysqli_query($conn,$sql_fetch_posts);
if(!$posts){
    echo "No New Posts";
}
else{
    $outp = "";
    while($row = $posts -> fetch_array(MYSQLI_ASSOC)){
        if($outp !=""){ $outp .=",";}
        $outp .='{"Title":"'    .$row["title"]      .   '",';
        $outp .='"Content":"'   .$row["content"]    .   '",';
        $outp .='"PostBy":"'    .$row["postBy"]     .   '",';
        $outp .='"PostId":"'    .$row["post_id"]     .   '",';
        $outp .='"Loc":"'    .$row["location_name"]     .   '",';
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
}
?>