<?php


    require("../authentications/config_tdb.php");

    $post_id = $_GET['post_id'];

    // Fetch the post details
    $sql = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id'");
    $post_data = mysqli_fetch_assoc($sql);


    $post_user_id = $post_data['unique_id'];

    // Fetch the Post Users ID details
    $sql2 = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$post_user_id'");

    $user_data = mysqli_fetch_assoc($sql2);

    // if($user_data){
    //     include "../servescrip/result.php";
    // }

    // echo "<img src=\"create_post/images/$post_img\">";

    echo $user_data['l_name'];
    

?>