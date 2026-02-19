<!DOCTYPE html>
<html>
    <head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
require('functions/generic_functions.php');
require('functions/database_functions.php');
require('functions/user_functions.php');
require('alertModal.php');
startSession();
defineSessionValues();
if(!isAdmin($_SESSION['role'])){
    echo'
    <script>myAlert("You are not allowed to enter if you are not administrator!")
    setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>';
    exit;
}
?>
</head>
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
    <div class="p-4" style="width: 60%;" id="createUserForm">
        <h3 class="text-center">Create a new user or administrator!</h3>
        <form action="create_user_server.php" method="POST" onsubmit="return checkEmptyFields()">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="Insert username" class="form-control"required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" placeholder="Insert email"class="form-control">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Insert phone"class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Insert password" class="form-control"required>
            </div>
                <select class="form-select" name="role" required>
                    <option value="" disabled selected>Choose role</option>
                    <option value="user">User</option>
                    <option value="admin">Administrator</option>
                </select>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="createUserButton">Create</button>
            </div>
        </form>
    </div>
</div>
<script>
    function checkEmptyFields(){
       var username = document.getElementById("username").value.trim();
       var password = document.getElementById("password").value.trim();
        if(username==="" || password===""){
            myAlert("You must insert non-empty values in both username and password fields!");
            return false;
        }
        return true;
    }
</script>   
</body>
</html>