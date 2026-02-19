<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><?php
require("functions/generic_functions.php");
require("functions/database_functions.php");
require("functions/user_functions.php");
require('alertModal.php');
if(!isRequestMethodPost()){
    exit("The method is not POST.You can't proceed!");
}
if(isThereSuchUser(trim($_POST['username']),trim($_POST['password']))){
startSession();
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $_SESSION=[
        'username'=>$username,
        'password'=>$password
    ];
    $sqlFindRole="SELECT role
    FROM users WHERE user_name='{$username}' AND user_password='{$password}'";
    $roleData=selectFromDb($sqlFindRole);
    $role=$roleData[0]['role'];
    $_SESSION['role']=$role;
    header("Location:index.php");
    exit();
}
else{
        echo'
        <script> 
        myAlert("There is no such user!");
        setTimeout(function() {
        window.location.href = "user_log_in.php";
        }, 2000);
        </script>';
        exit;
    }
?>
<!-- <script>
    document.addEventListener("DOMContentLoaded",()=>{
    let username=<?php echo $_SESSION['username']; ?>;
    let password=<?php echo $_SESSION['password']; ?>;
    stp=new XMLHttpRequest();
    stp.open("POST",'user_log_in.php');
    stp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      let data="username="+username+"&password="+password;
      stp.onreadystatechange = function() {
            stp.send(data);
          };
        }
        );
</script> -->