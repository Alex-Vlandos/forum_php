<?php
    require("functions/generic_functions.php");
    require("functions/database_functions.php");
    require('alertModal.php');
    if(!isRequestMethodPost()){
        exit("The method is not POST.You can't proceed!");
    }
    startSession();
    $postTitle=$_POST['postTitle'];
    $threadContent=$_POST['threadContent'];
    $threadContent = trim(preg_replace('/\xC2\xA0|\s+/', ' ', strip_tags($threadContent)));
    // var_dump($threadContent);
    $writtenBy=trim($_POST['writtenBy']);
    $postId=$_POST['post_id'];
    $username=$_SESSION['username'];
    $sql1="SELECT users.user_id
    FROM users WHERE user_name='$username'";
    $userId=selectFromDb($sql1)[0]['user_id'];
    $sql="INSERT INTO threads(post_id,user_id,content)
    VALUES ('$postId','$userId','$threadContent')";
    executeSqlQuery($sql);
    echo "<script>
        myAlert('You have successfully replied to post!');
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000); // 2 δευτερόλεπτα καθυστέρηση
      </script>";
    exit();
?>