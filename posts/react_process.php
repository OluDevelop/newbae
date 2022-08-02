<?php

    require("../authentications/config_tdb.php");
    session_start();

    $session_id = $_SESSION['unique_id'];
    $post_id = $_POST['post_id'];

    // Remove user like if this user is already following
    $sql1 = mysqli_query($con, "SELECT * FROM post_reactions WHERE love = 'love' AND unique_id = '$session_id'");

    if($sql1){
        $row = mysqli_num_rows($sql1);

        if($row > 0){
            // Remove the user like
            $remove_sql = mysqli_query($con, "DELETE FROM post_reactions WHERE love = 'love' AND unique_id = '$session_id'");
        }else{
            // Allow the user make a like reaction on the post
            $sql = mysqli_query($con, "INSERT INTO post_reactions (love, unique_id, post_id) VALUES ('love', '$session_id', '$post_id')");
        }
    }
    
    




?>