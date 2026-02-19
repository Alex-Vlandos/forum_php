<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
    require("functions/generic_functions.php");
    require("functions/database_functions.php");
    require('alertModal.php');
    if(!isRequestMethodPost()){
        exit("The method is not POST.You can't proceed!");
    }
    // startSession();
    $username=$_POST['username'];
    $sql="SELECT *
    FROM users
    WHERE user_name='{$username}'";
    $data=selectFromDb($sql);
    if(!empty($data)){
        echo'
        <script>
        myAlert("There is already a user with this name!");
        setTimeout(()=>{
        window.location.href="user_sign_up.php";
        },2000);
        </script>';
        exit;
    }
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $phone=trim($_POST['phone']);
    $password=trim($_POST['password']);
    $userdata=[
        'user_name'=>$username,
        'email'=>$email,
        'phone'=>$phone,
        'user_password'=>$password
    ];
    $keys="";
    $rows="";
    foreach($userdata as $key=>$value){
        if($value || $value==0){  
        $keys.="$key,";
        $rows.="'{$value}',";
        }
    }
    $keys=rtrim($keys,',');
    $rows=rtrim($rows,',');
    $sql="INSERT INTO users($keys)
    VALUES ($rows)";
    executeSqlQuery($sql);
    echo'
    <script>myAlert("You have succesfully signed up!")
    setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>';
    exit();
    // var_dump($_SESSION);
?>