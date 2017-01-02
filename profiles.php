<?php
include("connect2sql.php");
session_start();
$profile_user = $_GET['id'];
$employee_id=$_SESSION['emp_id'];
$sql = "SELECT * FROM PROFILE p JOIN Department d on p.dept_id=d.dept_id WHERE username = '$profile_user'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));
//echo $_SESSION['emp_id'];
//echo $profile_user;
?>

<html> 
    <head>
    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/post.css">

    <link rel="stylesheet" href="assets/profile.css">
    </head>
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.js'></script>
    <body ng-app="app" > 
  
      <div class = "header">
     <a class="left" HREF="home_feed.phtml">Home</a> 
<a class="left" HREF="notifications.php"> Notifications </a>
  <a class="right" href="logout.php">Logout</a></div>

        <div id = profile class="main-content"> 
            <table>
                <tr>
                    <td rowspan=100%><img src="<?php echo $result["Display"]?>" height=120px/> 
                    <td><strong><?php echo $result["First_Name"]." ".$result["Last_Name"] ?></strong></td>
                    
                    </tr>
                <tr><td>Username:</td> <td><span><?php  echo $result["username"]; ?></span></td></tr>

                <tr><td>Position: </td> <td><span><?php echo $result["Position"] ?></span></td></tr>
                <tr><td>Department Name: </td> <td><span><?php echo $result["Department_Name"] ?></span></td></tr>
                <tr><td>Email Id:</td> <td> <span><?php echo $result["email_id"] ?></span></td></tr>

                <tr><td>
                   
               <?php

                   // $profile_user=$_SESSION['emp_id'];
                    //echo $profile_user;

                    $current_emp_id=$employee_id;

               $sql1 = "SELECT * FROM user  WHERE username = '$profile_user'";
               $sql_result1=mysqli_query($conn, $sql1);
               $values1 = mysqli_fetch_array($sql_result1);
               
               $check_emp_id=$values1[1];
               $_SESSION['login_emp_id']=$check_emp_id;


$sql5="SELECT * FROM connections where status=1 AND (user_1=$current_emp_id OR  user_2=$current_emp_id ) ";
$sql_result=mysqli_query($conn,$sql5);   
$flag=1;


while($row1 = mysqli_fetch_assoc($sql_result)){ 
//echo "RUN" ."<br>";

//echo $row1['user_1'] ." " .$row1['user_2'];

//echo 'Login user  Emp id..' ."<br>";
//echo $current_emp_id;

//echo 'Check Profile Emp ID..' ."<br>";
//echo $check_emp_id;


 if($row1['user_1']==$current_emp_id){
       if($row1['user_2']==$check_emp_id)
       {
        $flag=0;
        break;
       }
 }
 else if($row1['user_2']==$current_emp_id){
    if($row1['user_1']==$check_emp_id){
        $flag=0;
        break;
       }

 } else{
    $flag=0;
 }


if($current_emp_id==$check_emp_id){
    $flag =0;
}

}

if($flag==1){
   echo "
   <div><form method='post' action='sendfriendrequest.php'>
         <input type='submit' name='sendrequest' value='Send Friend Request' class='btn'/>
         </form> </div>";
}





?>


                 </td>  
                </tr>
            </table>
        </div>

<div ng-controller='PostsCtrl' class='main-content'>
            <h2>Recent Posts</h2> <a class="refresh_button" href="profiles.php?id=<?php echo $profile_user?>">
            <img src="refresh.png"  width="20" height="20"></a>
        <ul class='list-group'>
        <li ng-repeat="p in posts" class='container-item'>
            
          <strong ng-model = "post_title">{{p.Title}}</strong><br>
          
          <span><a href="profiles.php?id={{p.PostBy}}">@{{p.PostBy}} </a>  </span><br>
          
          <span>{{p.Content}}</span><br>
          <span>{{p.Loc}}</span><br>
         <img class="image" src="{{p.attachment}}" width="350" height="auto" />
         <br>
          
          <button ng-click="like(p.PostId)" name="like" >
              {{p.likes}} <img src = "like.png" width="20" height="20">
          </button>
          <input type = "text" ng-model = "cmt_content" >
          
          <button ng-click = "comment(p.PostId,cmt_content)" name="comment">
            <img src="comment.png" width="20" height="20">
          
          </button>
        
        <br>
          <div class="comments_area">
            
              <ul>

              <li ng-repeat="c in p.comments" class='container-comment'>
                
                <span>{{c.cmt_content}}</span>
                  <span class="cmt">{{c.cmtBy}}</span>
                </li>
            </ul>
            
          </div>
            
      </li>
            <br>
    </ul>

    </div>

    </body>

<script>        
    
var timeline = angular.module('app',[]);
timeline.controller("PostsCtrl",function ($scope, $http){
    
    $http.get("timeline.php?id=<?php echo $_GET['id']?>").then(function(response){
        $scope.posts = response.data.records;
        //$scope.comments = response.data.records.comments;
        });
   
    
    $scope.like = function(pid){
        console.log(pid);
        $http({
            url:'likes.php',
            method:'POST',
            data: {
                pid: pid
            }

        }).then (function(response){
           console.log(JSON.stringify(response));
        });
        
    }
    
    $scope.comment = function(pid, comment){
        console.log(comment);
        $http({
            url:'comments.php',
            method:'POST',
            data: {
                pid: pid,
                content: comment 
            }
        }).then(function(response){
            console.log(JSON.stringify(response));
        })
    }
  
});
        
</script>

    
</html>
    