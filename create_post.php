<?php
session_start();

include ("connect2sql.php") ;


IF($_SERVER['REQUEST_METHOD']=='POST'){
    $user = $_SESSION['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $loc_id = $_POST['loc'];
    $viz = $_POST['viz'];
}

if(!file_exists($_FILES['myfile']['tmp_name']) || !is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    echo "No upload";
  
    $sql_post = "INSERT INTO POST (postBy, postTime, title, content, loc_id, viz) VALUES ('$user',now(),'$title','$content','$loc_id','$viz')";        
    if(mysqli_query($conn, $sql_post)){
    
    echo 'post shared.';
    header("location:home_feed.phtml");
} 
else{
    echo mysqli_error($conn);
}
}
else{
    echo "upload... <br>";
    $file = $_FILES['myfile'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_ext = explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $file_name_new = uniqid('', true).'.'.$file_ext;
    $file_destination = 'uploads/'.$file_name_new;

    if (move_uploaded_file($file_tmp,$file_destination)){
        echo $file_destination;
    } 
    $sql_post = "INSERT INTO POST (postBy, postTime, title, content, loc_id, viz) VALUES ('$user',now(),'$title','$content','$loc_id','$viz') ";
    $result = mysqli_query($conn,$sql_post);
    echo "TEST";
    $sql_postid = "SELECT LAST_INSERT_ID()";
    $pid = mysqli_fetch_array(mysqli_query($conn,$sql_postid))[0];
    echo $pid;
        
    $sql_multimedia = "INSERT INTO post_attachment(Att_Name, Att_ContentType,parent_post_id) VALUES('$file_name','$file_destination','$pid')" ;
    if(mysqli_query($conn,$sql_multimedia)) {
        echo "multimedia inserted.";
        header("location:home_feed.phtml");
    }
    else{
        echo mysqli_error($conn);
    }
    
    
}

       

?>