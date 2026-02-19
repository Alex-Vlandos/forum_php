<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce/tinymce.min.js"></script>
</head>
<?php
    require("functions/user_functions.php");
    require('functions/generic_functions.php'); 
    require('alertModal.php');
    startSession();
    if(!isLoggedInUser($_SESSION['username'],$_SESSION['password'])){
        echo '<script>
        myAlert("You are not logged in!");
        setTimeout(()=>{
        window.location.href="index.php";
    },2000);
        </script>';
        exit;
    }
?>
<body>
<div class="container">
            <div class="row">
    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Go back to the home page</button>
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
  </div>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="p-4" style="width: 60%;" id="creationForm">
        <h3 class="text-center">Create a post</h3>
        <form action="post_creation_server.php" method="POST" onsubmit="return checkEmptyFields()">
        <div class="mb-3">
        <label for="postTitle" class="form-label">Post Title</label>
        <textarea type="text" id="postTitle" placeholder="Insert content!" class="form-control" name="postTitle"></textarea>
        </div>
        <!-- <div class="mb-3">
        <label for="postContent" class="form-label">First thread(Optional)</label>
        <textarea type="text" id="postContent" placeholder="Insert content!" class="form-control" name="postContent" required></textarea>
        </div> -->
        <div class="mb-3">
        <button type="submit">Create</button>
        </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: '#postTitle',
        entity_encoding: 'raw',
        menubar: false,
        branding: false,
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        //license_key: 'fvm0f1p8r67dzf24vllnjl5sfd4yaidlphlpiar85p9xx0ge' // Αν δεν έχεις API key
        license_key: 'gpl'
    });
});
        
    function checkEmptyFields(){
        // console.log("checking...");
       var postTitle = tinymce.get("postTitle").getContent()
        .replace(/&nbsp;/g, ' ')  // Αντικαθιστούμε τα &nbsp; με κενό
        .replace(/<[^>]*>/g, '')
        .trim();
    //    var firstThread = tinymce.get("postContent").getContent()
    //     .replace(/&nbsp;/g, ' ')  // Αντικαθιστούμε τα &nbsp; με κενό
    //     .replace(/<[^>]*>/g, '')
    //     .trim();
        if(postTitle===""){
            myAlert("You must insert a post title!");
            return false;
        }
    //     if (empty(firstThread)) {
    //         myAlert("The first thread cannot contain only spaces!");
    //     return false;
    // }
        return true;
    }
</script>
</body>
</html>
    