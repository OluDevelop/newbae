<?php


    session_start();
    require("../authentications/config_tdb.php");

    $post_id = $_REQUEST['post_id'];
    $session_id = $_REQUEST['session_id'];
    $user_ids = $_REQUEST['user_id'];
    $session = $_SESSION['unique_id'];

    // Delete for Repost ID
    $sql = mysqli_query($con, "DELETE FROM posts WHERE re_post_id = '$post_id' AND unique_id = '$session'");

    // Redirect
    header("location: ../");


?>