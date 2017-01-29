
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

$pr_user=$_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
     //$_SESSION['username'];
    $pr_first = $_POST['first_name'];
    $pr_last = $_POST['last_name'];
    $pr_dob = date('Y-m-d',strtotime($_POST['dob']));
    //echo $pr_dob;
    $pr_email = $_POST['email'];
    
    $loc_name=$_POST['sub2'];
    //$pr_loc = $_POST['location'];
    $pr_pos = $_POST['position'];
    
}

$target_dir = "uploads/";


$sql_get_loc_id="SELECT locid from locations where location_name='$loc_name'";

$loc_check = mysqli_query($conn,$sql_get_loc_id);

$values1 = mysqli_fetch_array($loc_check);
$pr_loc=$values1[0];

//echo 'adsva';
//echo isset($_FILE['display_pic']);

$target_file = $target_dir.basename($_FILES["display_pic"]["name"]);


$file = $_FILES['display_pic'];

//print_r($file);

$file_name = $file['name'];
$file_tmp = $file['tmp_name'];
$file_ext = explode('.',$file_name);
$file_ext = strtolower(end($file_ext));
$file_name_new = uniqid('', true).'.'.$file_ext;
$file_destination = 'uploads/'.$file_name_new;

if (move_uploaded_file($file_tmp,$file_destination)){
    echo $file_destination;
}
//if (isset($_FILE['display_pic'])){
   
    //the user has selected a picture to be uploaded
    
    $img_filetype = pathinfo($target_file,PATHINFO_EXTENSION);
    
    /*
    $check =1;
    // getimagesize($_FILES["display_pic"]["tmp_name"]);
    
    if($check){
        echo "File is an image.";
    $Ok_Upload = 1;
    }
    else{
        echo "File is not an image.Try again";
        $Ok_Upload = 0;
    }
    if($Ok_Upload == 0 ){
    echo "Sorry your file could not be uploaded.";
    }

   else{

    */

    /*
       if(move_uploaded_file($_FILES["display_pic"]["tmp_name"],$target_file)){
        echo "The Display Pic". basename($_FILES["display_pic"]["name"])." has been uploaded";
        
    }
    else{
        echo "Sorry your file could not be uploaded.";
    }
    */
    
//}

$pr_dept_id = 1;
//code for display picture upload:

$sql_profile = "INSERT INTO PROFILE(username, First_Name, Last_Name, dept_id, 
    Position, d_o_b, email_id,location, Display ) 
VALUES('$pr_user','$pr_first','$pr_last','$pr_dept_id','$pr_pos','$pr_dob','$pr_email','$pr_loc', '$file_destination')";

if(mysqli_query($conn,$sql_profile)) {
    
    header("location:home.php");
    echo "Profile created successfully";

} 
else
{
    $_SESSION['message3']='Please try again.';
                header('Location: profile_build.php');
       echo "Error: \n". mysqli_error($conn);
        exit();

    }

?>