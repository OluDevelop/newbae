<?php
session_start();

    // Includes 
    include "../authentications/config_tdb.php";

    $followed = mysqli_real_escape_string($con, $_POST['followed_id']);
    $logged_in = $_SESSION['unique_id'];

    $sql1 = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$logged_in'");

    if($userdata = mysqli_fetch_assoc($sql1)){
        $f_name = $userdata['f_name'];
        $l_name = $userdata['l_name'];
    }

    date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
    $time = date("Y-m-d h:i:sa");

    // Send Friend Request Notification
    $notify_sql = mysqli_query($con, "INSERT INTO notifications (sender_id, receiver_id, notification_content, timesent) VALUES ('$logged_in', '$followed', 'Sent a friend request', '$time')");
?>