<?php

session_start();

    // Includes 
    include "../authentications/config_tdb.php";

    $followed = mysqli_real_escape_string($con, $_POST['followed_id']);
    $logged_in = $_SESSION['unique_id'];

    // Add the follower
    $sql = mysqli_query($con, "DELETE FROM notifications WHERE sender_id = '$logged_in' AND receiver_id = '$followed'");
?>