<?php

    session_start();
    require("../authentications/config_tdb.php");

    $post_id = $_GET['post_id']; // The Post ID
    $user_id = $_GET['user_id']; // The post Owner
    $session_id = $_SESSION['unique_id']; // From Session

    // Fetch  From Post Table
    $sql1 = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id'");
    $sql_fetch = mysqli_fetch_assoc($sql1);

    // $owner_id = $sql_fetch['unique_id'];
    $text = $sql_fetch['post_text'];
    $img = $sql_fetch['post_img'];
    $vid = $sql_fetch['post_vid'];
    $time = $sql_fetch['timeposted'];
    

    $t = time();
    $a = rand(23093, 5038271983);
    $f = $t . $a;

    //Time Post was posted
    date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
    $period = date("Y-m-d h:i:sa");

    // Send to Post DB
    $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_img, post_id, timeposted, post_vid, repost, owner_id, re_post_id, timeposted2)
        VALUES ('$session_id', '$text', '$img', '$post_id', '$time', '$vid', '1', '$user_id', '$f', '$period')");
    
    header("location: ../");


?>