<?php


    session_start();
    require("../authentications/config_tdb.php");

    // Update Love Reaction Table
    $post_id = $_POST['post_id'];
    $session_id = $_SESSION['unique_id'];

    // Check if this user as liked this post
    $query = mysqli_query($con, "SELECT * FROM love_reaction_table WHERE post_id = '$post_id' AND unique_id = '$session_id'");

    $row = mysqli_num_rows($query);

    if($row > 0){
        // Delete the like from the post
        $del_query = mysqli_query($con, "DELETE FROM love_reaction_table WHERE post_id = '$post_id' AND unique_id = '$session_id'");
    }else{
        // Add the Like to the Post
        $sql = mysqli_query($con, "INSERT INTO love_reaction_table (post_id, unique_id) VALUES ('$post_id', '$session_id')");
    }




?>