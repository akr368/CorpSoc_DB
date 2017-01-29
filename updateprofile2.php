
<?php
session_start();

$username="root";
    $password="ashwin92";
    $db="CorpSocNet";


// Connect to the mysql server
$conn = mysqli_connect("localhost",$username, $password, $db, 0, '/tmp/mysql.sock');
if (! $conn){
  die("Could not connect: "+ mysqli_error());
  echo "Connection could not be established";
} 
else {
    echo "Connected.<br>";
}

$pr_user=$_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"]=="POST"){

     //$_SESSION['username'];
    $pr_first = $_POST['first_name'];
    $pr_last = $_POST['last_name'];
    $pr_dob = date('Y-m-d',strtotime($_POST['dob']));
    $pr_email = $_POST['email'];
    //$pr_loc = $_POST['location'];
    $loc_name=$_POST['sub2'];
    $pr_pos = $_POST['position'];

}

$target_dir = "uploads/";

$sql_get_loc_id="SELECT locid from locations where location_name='$loc_name'";
$loc_check = mysqli_query($conn,$sql_get_loc_id);
$values1 = mysqli_fetch_array($loc_check);
$pr_loc=$values1[0];



$target_file = $target_dir.basename($_FILES["display_pic"]["name"]);
$file = $_FILES['display_pic'];


$file_name = $file['name'];
$file_tmp = $file['tmp_name'];
$file_ext = explode('.',$file_name);
$file_ext = strtolower(end($file_ext));
$file_name_new = uniqid('', true).'.'.$file_ext;
$file_destination = 'uploads/'.$file_name_new;

if (move_uploaded_file($file_tmp,$file_destination)){
    echo $file_destination;
}
    
$img_filetype = pathinfo($target_file,PATHINFO_EXTENSION);
$pr_dept_id = 1;

if(!file_exists($_FILES['myfile']['tmp_name']) || !is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    echo 'No upload';
$sql_profile="UPDATE Profile SET First_Name='$pr_first', Last_Name='$pr_last', 
dept_id='$pr_dept_id', Position='$pr_pos', d_o_b='$pr_dob', email_id='$pr_email',location=$pr_loc,
 Display='$file_destination' where username='$pr_user'" ; 

if(mysqli_query($conn,$sql_profile)) {
    echo "Profile updated successfully";
    header("location:profiles.php?id=$pr_user");
} 

else
{
       echo "Error: \n". mysqli_error($conn);
        exit();
}

}
else{


        echo ' upload..';
        
$sql_profile="UPDATE Profile SET First_Name='$pr_first', Last_Name='$pr_last', 
dept_id='$pr_dept_id', Position='$pr_pos', d_o_b='$pr_dob', email_id='$pr_email',location=$pr_loc,
 Display=null where username='$pr_user'"; 

if(mysqli_query($conn,$sql_profile)) {
    echo "Profile updated successfully";
    header("location:profiles.php?id=$pr_user");;
} 
else
{
       echo "Error: \n". mysqli_error($conn);
        exit();
}



}



?>