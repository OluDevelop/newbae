<?php


    session_start();
    require("../authentications/config_tdb.php");

    $post_id = $_REQUEST['post_id'];
    $session_id = $_REQUEST['session_id'];
    $user_ids = $_REQUEST['user_id'];

    // Delete Post From the Post Table
    $sql = mysqli_query($con, "DELETE FROM posts WHERE post_id = '$post_id' AND unique_id = '$session_id'");
    $sql2 = mysqli_query($con, "DELETE FROM posts WHERE post_id = '$post_id'");
    
    // Redirect
    header("location: ../");


?>