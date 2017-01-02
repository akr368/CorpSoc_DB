<?php
    session_start();
    include("connect2sql.php");

    $usr = "brad223";

    $session_user = $_SESSION['user'];
    
    $sql_query = "SELECT * FROM PROFILE p JOIN DEPARTMENT d ON p.dept_id = d.dept_id WHERE username = '$usr'";
    $result = mysqli_query($conn,$sql_query);
    $row = mysqli_fetch_array($result);
    
    $outp ="";
    
    if($outp !="") { $outp .=",";}
        $outp .='{"FirstName": "'    .$row["First_Name"]      .   '",';
        $outp .='"LastName": "'   .$row["Last_Name"]    .   '",';
        $outp .='"username": "'    .$row["username"]    .   '",';
        $outp .='"Position": "'    .$row["Position"]     .   '",';
        $outp .='"Department": "'  .$row["Department_Name"] .   '",';
        $outp .='"Email": "'    .$row["email_id"]     . '",';
        $outp .='"Display": "'  .$row["Display"]    .   '"}';   
    $outp = '{"records":['.$outp.']}';
    echo ($outp);


    ?>