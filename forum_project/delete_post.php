<?php
require('functions/database_functions.php');
    if(isset($_POST['post_id'])){
        $postId=$_POST['post_id'];
        $sqlDeletePost="DELETE FROM posts
        WHERE post_id=$postId";
        executeSqlQuery($sqlDeletePost);
    }
?>
