<?php
session_start();
$user = "root";
$password = "ashwin92";
$db = "CorpSocNet";

// Connect to the mysql server
$conn = mysqli_connect("localhost",$user, $password, $db, 0, '/tmp/mysql.sock');
if (! $conn){
    die("Could not connect: "+ mysqli_error());
    echo "Connection could not be established";
} 
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $in_username = $_POST["username"];
    $in_emp_id = $_POST["emp_id"];
    $dept_name = $_POST["sub1"];
    $in_passid = $_POST["passid"];
    $in_proj_code = $_POST["proj_code"];   
    $_SESSION['user'] = $_POST["username"]; 
}

$sql_get_dept_id="SELECT dept_id from Department where Department_name='$dept_name'";
$dept_check = mysqli_query($conn,$sql_get_dept_id);

$values1 = mysqli_fetch_array($dept_check);
 $in_dept_id=$values1[0];
 

$sql_username_check = "SELECT emp_id, username FROM User WHERE username = '$in_username' OR emp_id = '$in_emp_id' ";

//if input username exists, they have to input a new username
$user_check = mysqli_query($conn,$sql_username_check);

if(mysqli_num_rows($user_check)>0){

       // echo 'user exists';

$_SESSION['message1']='Please try again.';
    //exit();
        header('Location: registration_form.php');
    //username already exists

}    
else{
    echo 'username and emp_id valid';
    $sql_check = "SELECT * FROM project WHERE project_code = '$in_proj_code' AND dept_id= '$in_dept_id'";
    $check = mysqli_query($conn,$sql_check);
    
        if(mysqli_num_rows($check)>0){
            
            echo 'project and department valid';
            
            $new_row = "INSERT INTO USER(username, emp_id,password,dept_id,proj_code,last_login) VALUES ('$in_username', '$in_emp_id','$in_passid','$in_dept_id','$in_proj_code',now())";
            
            if (mysqli_query($conn,$new_row)){
                echo 'TEST12';
                header('Location: profile_build.php');
                
            }else{
                $_SESSION['message1']='Please try again.';
                header('Location: registration_form.php');
                echo "Error: %s\n", mysqli_error($conn);
                exit();
            }
        
        }
    else {
        

    $_SESSION['message1']='Please try again.';
    header('Location: registration_form.php');
        echo "asdas";
    }
        //department is correct
        
    }
?>