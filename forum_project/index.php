<!DOCTYPE html>
<?php
require('functions/generic_functions.php');
require('functions/database_functions.php');
require('functions/user_functions.php');
startSession();
defineSessionValues();
require('thread_reply.php');
require('alertModal.php');
if(!isset($_SESSION['role'])){
$_SESSION['role']='user';
}
// session_unset();
// session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->


    <script>
          
    function createPost(){
      window.location.href = "post_creation.php";
    }
    function takeValues(buttonElement) {
    const postContainer = buttonElement.closest('.post');
    
    const postTitle = postContainer.querySelector('p[id^="answerTitle"]').textContent;
    
    const writtenBy = postContainer.querySelector('p').textContent.replace("by ", "").trim();
    
    const postId = buttonElement.id.replace("button-", "");

    document.getElementById("replyModalLabel").textContent = "Reply to post:" + postTitle;
    document.getElementById("hiddenInput1").value = postTitle;
    document.getElementById("hiddenInput2").value = writtenBy;
    document.getElementById("hiddenInput3").value = postId;
    showReplies(postId);
}

    function transferId(button){
      myAlert("This post was succesfully deleted!");
      let closestPost=button.closest('div[id^="wholePost"]');
      let postId=button.id.replace("button-", "");
      const xml=new XMLHttpRequest();
      xml.open("POST","delete_post.php",true);
      xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      let data="post_id="+postId;
      xml.onreadystatechange = function() {
              if (xml.readyState == 4 && xml.status == 200) {
                  closestPost.remove();
              }
          };
        
      xml.send(data);
      
    } 
    </script>
    <title>Forum</title>
</head>
<body>
<div class="container" id="actions">
  <div class="row">
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
    <button type="button" class="btn btn-secondary" onclick="createPost()">Start new discussion</button>
    <?php
      if(!empty($_SESSION['username'])){
        $username=$_SESSION['username'];
        echo "
        <div id='welcome'>
        <h2> Welcome $username you are logged in! </h2>
        </div>";
      }
      ?>
    </div>
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4"></div>
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb"  id="myBreadcrumb">
        <li class="breadcrumb-item"><a href="user_sign_up.php">Sign up</a></li>
        <li class="breadcrumb-item"><a href="user_log_in.php">Log in</a></li>
        <li class="breadcrumb-item"><a href="logout_user.php">Logout</a></li>
        <?php
        // var_dump($_SESSION['role']);
        if(isAdmin($_SESSION['role'])): ?>
        <li class="breadcrumb-item"><a href="create_user.php">Create user or admin</a></li>
        <?php endif; ?>
      </ol>
    </nav>
    </div>
  </div> 
  <div class="row" id="mainBar">
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
      <h3>Topics</h3>
    </div>
    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2"></div>
    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
      <h3>POSTED ON</h3>
    </div>
      <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
      <h3>REPLIES</h3>
    </div>
      <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
      <h3>VIEWS</h3>
    </div>
    </div>
<div class="row">
<?php
  if(!isset($resultvalues)){
    $resultValues=[];
  }
    $sql="SELECT users.user_name,posts.post_title,posts.created_at,posts.post_id
    FROM posts INNER JOIN users
    ON posts.user_id=users.user_id";
    $data=selectFromDb($sql);
    // displayReplies();
  if(empty($data)){
      echo'
      <div id="no_post">
      There is no post created yet!
      </div>';
      exit;
  }
  foreach($data as $array){
      foreach($array as $value){
        $resultValues[]=$value;
      }  
  }
  // var_dump($resultValues);
  $i=0;
  while(isset($resultValues[$i+3])): ?>
      <div class="row post"id="wholePost-<?php echo $resultValues[$i+3]; ?>">
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
              <form>
                  <p id="answerTitle-<?php echo $resultValues[$i+3]; ?>"><?php echo $resultValues[$i+1]; ?></p>
                  <p>by <?php echo $resultValues[$i]; ?></p>
                  <button id="button-<?php echo $resultValues[$i+3]; ?>" type="button" class="btn btn-primary" 
                          data-bs-toggle="modal" data-bs-target="#replyModal" 
                          onclick="takeValues(this)">Reply/see existing replies</button>
                          <?php if(isAdmin($_SESSION['role'])):?>
                          <button id="button-<?php echo $resultValues[$i+3]; ?>" type="button" class="btn btn-primary" onclick="transferId(this)">Delete</button>
                          <?php endif;?>
              </form>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
              <p><?php echo $resultValues[$i+2]; ?></p>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
              <h1 id="reply-<?php echo $resultValues[$i+3]; ?>">REPLIES</h1>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 lastColumn">
              <h1 id="view-<?php echo $resultValues[$i+3]; ?>">VIEWS</h1>
          </div>
      </div>
  <?php 
      $i+=4; 
  endwhile;
  ?>
</div>
</div>
</body>
</html>