<?php


    session_start();
    require("../authentications/config_tdb.php");


    $session_id = $_SESSION['unique_id'];
    $post_id = $_POST['post_id'];

    $sql2 = mysqli_query($con, "SELECT * FROM bookmarks WHERE post_id = '$post_id' AND unique_id = '$session_id'");
    $row = mysqli_num_rows($sql2);

    if($row < 1){
        // Insert The Select POST into the BOOKMARK TABLE
        $sql = mysqli_query($con, "INSERT INTO bookmarks (unique_id, post_id) values ('$session_id', '$post_id')");
    }else{
        echo "0";
    }

    


    $pd = $_POST['post_id'];
    
    // Select all post the current user has saved
    $sql3 = mysqli_query($con, "SELECT * FROM bookmarks WHERE post_id = '$post_id' AND unique_id = '$session_id'");
    $row = mysqli_num_rows($sql3);



?>