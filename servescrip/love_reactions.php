<?php
    session_start();
    require("../authentications/config_tdb.php");

    // Check if this user has liked the post
    // $post_id = $_POST['post_id'];
    // $session_id = $_SESSION['unique_id'];

    // $sql = mysqli_query($con, "SELECT * FROM love_reaction_table WHERE post_id = '$post_id' AND unique_id = '$session_id'");

    // $row = mysqli_num_rows($sql);

    // echo $row;

    // Fetch Like Count
    // function countAllLikes(){
    //     
    // }

    $post_id = $_REQUEST['post_id'];

    $sql_likes = mysqli_query($con, "SELECT * FROM love_reaction_table WHERE post_id = '$post_id'");
    $row_likes = mysqli_num_rows($sql_likes);
    
    echo $row_likes;


    // if($row > 0){
    //     echo "Yes";
    // }else{
    //     echo "No";
    // }
?>