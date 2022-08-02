<?php
    session_start();

    // Includes 
    include "../authentications/config_tdb.php";

   $sender_id = mysqli_real_escape_string($con, $_REQUEST['bup']); 
   $logged_in = $_SESSION['unique_id'];

   // Fetch the sender ID name from the database

   $Sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$sender_id'");

   $sql_fetch = mysqli_fetch_assoc($Sql);

   $f_name = $sql_fetch['f_name'];
   $l_name = $sql_fetch['l_name'];

    // Add the follower
    $sql = mysqli_query($con, "INSERT INTO followers (followed_id, following_id, f_name, l_name) VALUES ('$sender_id', '$logged_in', '$f_name', '$l_name')");

    // Update Notification Table
    $sql2 = mysqli_query($con, "UPDATE notifications SET `status` = '1' WHERE sender_id = '$sender_id' AND receiver_id = '$logged_in'");

    if(isset($_REQUEST['source'])){
        header("Location: ../friends/request.php");
    }else{
        header("Location: ../notifications");
    }


?>