<?php

    session_start();
    require("../authentications/config_tdb.php");

    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    $unique_id = $_SESSION['unique_id'];
    $post_id = $_POST["post_id"];

    // Fetch the Post Owner ID
    $postSql = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id' LIMIT 1");
    $fetch = mysqli_fetch_assoc($postSql);
    $receiver_id = $fetch['unique_id'];

    // Comment ID Generation
    $a = rand(12, 200222335);
    $b = time();
    $c = rand("ANDOFLEMSGV");

    $comment_id = $a . $b . $c;

    //Time Post was posted
    date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
    $period = date("Y-m-d h:i:sa");
    
    if($comment != ""){
        // Insert the comment into the post reactions table
        $sql = mysqli_query($con, "INSERT INTO post_reactions (comment, unique_id, post_id) VALUES ('$comment', '$unique_id', '$post_id')");

        if($receiver_id != $unique_id){
            // Send Notification to the Receiver
            $sqlSend_notification = mysqli_query($con, "INSERT INTO notifications (sender_id, receiver_id, notification_content, timesent, `status`, post_id, comment, comment_id) VALUES ('$unique_id', '$receiver_id', 'Comment on your Post', '$period', '0', '$post_id', '$comment', $comment_id)");

            // Update Red Dot Notification
            $redSql = mysqli_query($con, "UPDATE notifications SET red_dot_not = 0 WHERE receiver_id = $unique_id");
        }
        
    }

?>