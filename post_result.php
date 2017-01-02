<!DOCTYPE html>
<html>
    <head>
    
<link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/Post.css">
</head>
   
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.js'></script>
<body ng-app="app">
        <div class="header">
      <a class="left" HREF="home_feed.phtml"> Home </a>
      <h1>Search Results</h1>
    </div>
<div ng-controller='PostsCtrl' class='main-content'>
    <h2>Searched Posts</h2> <a class="refresh_button" href="post_result.php?search=<?php echo $_GET['search']?>"><img src="refresh.png"  width="20" height="20"></a>
    <ul class='list-group'>
      <li ng-repeat="p in posts" class='container-item'>
            
          <strong ng-model = "post_title">{{p.Title}}</strong><br>
          
          <span><a href="profiles.php?id={{p.PostBy}}">@{{p.PostBy}} </a>  </span><br>
          
          <span>{{p.Content}}</span><br>
         <img class="image" src="{{p.attachment}}" width="350" height="auto" /> <br>
          
          <button ng-click="like(p.PostId)" ng-model ="like" >
              <span>{{p.likes}}</span>  
              <img src = "like.png" width="20" height="20">
          </button>
          <input type = "text" ng-model = "cmt_content">
          
          <button ng-click = "comment(p.PostId,cmt_content)" name="comment"><img src = "comment.png" width="20" height="20">
          
          </button>
        
        <br>
          <div >
            
              <ul>

              <li ng-repeat="c in p.comments" class='container-comment'>
                
                <span>{{c.cmt_content}}</span>
                  <span class="cmt">{{c.cmtBy}}</span>
                </li>
            </ul>
            
          </div>
      </li><br>
    </ul>

    </div>
    
<script>
    
var app = angular.module('app',[]);
app.controller("PostsCtrl",function ($scope, $http){
    
    $http.get("search_posts.php? search=<?php echo $_GET['search']?>").then(function(response){
        $scope.posts = response.data.records;
        $scope.comments = response.data.records.comments;
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
    </body>
</html>