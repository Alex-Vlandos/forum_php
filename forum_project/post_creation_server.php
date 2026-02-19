<?php
require("functions/generic_functions.php");
require("functions/database_functions.php");
require('alertModal.php');
if (!isRequestMethodPost()) {
    exit("The method is not POST. You can't proceed!");
}

startSession();

$_SESSION['postTitle'] = $_POST['postTitle'];
// $_SESSION['postContent'] = trim($_POST['postContent']);

$postTitle = trim(preg_replace('/\xC2\xA0|\s+/', ' ', strip_tags($_SESSION['postTitle'])));
// $postContent = $_SESSION['postContent'];
$username = $_SESSION['username'];


$sqlUserId = "SELECT user_id FROM users WHERE user_name = '$username'";
$userIdArray = selectFromDb($sqlUserId);
if (empty($userIdArray)) {
    echo'
    <script>
    myAlert("User not found!");
    setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>';
    exit();
}
$userId = $userIdArray[0]['user_id'];


$sqlInsertPostTitle = "INSERT INTO posts(user_id, post_title) VALUES ('$userId', '$postTitle')";
// $postId=
executeSqlQuery($sqlInsertPostTitle);


// $sqlInsertFirstThread = "INSERT INTO threads(post_id, user_id,content) VALUES ('$postId','$userId', '$postContent')";
// executeSqlQuery($sqlInsertFirstThread);
echo'
    <script>
    myAlert("You have successfully created this post!");
    setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>';

// header('Location: index.php');
exit();
?>
