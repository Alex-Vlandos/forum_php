<?php
require('functions/database_functions.php');
require('alertModal.php');
// var_dump($_POST['thread_id']);
// var_dump($_POST['post_id']);
if(isset($_POST['thread_id'],$_POST['post_id'])){
    $threadId = $_POST['thread_id'];
    $postId = $_POST['post_id'];
    $sqlDeleteThread = "DELETE FROM threads WHERE thread_id='$threadId' AND post_id='$postId'";
    executeSqlQuery($sqlDeleteThread);
    echo '<script>
    myAlert("This thread was successfully deleted!");
    setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>';
    exit;
}
?>

