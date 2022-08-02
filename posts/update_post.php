<?php

    session_start();
    require("../authentications/config_tdb.php");

    $post_id = $_GET['id'];
    $user_id = $_GET['user_id'];
    $text = $_GET['text'];

    //Time Post was posted
    date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
    $period = date("Y-m-d h:i:sa");

    // Update The Post Text
    $sql = mysqli_query($con, "UPDATE posts SET post_text = '$text', edited = '1', timeposted2 = '$period' WHERE post_id = '$post_id' AND unique_id = '$user_id'");


?>