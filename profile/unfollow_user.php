<?php

session_start();

    // Includes 
    include "../authentications/config_tdb.php";

    // Unfollow for Friends Request Page
    if(isset($_REQUEST['source'])){



        $logged_in = $_SESSION['unique_id'];
        
        $sender_id = $_REQUEST['source'];
        $sql2 = mysqli_query($con, "DELETE FROM followers WHERE followed_id = '$sender_id' AND following_id = '$logged_in' OR
        following_id = '$sender_id' AND followed_id = '$logged_in'");

        // Also delete from the notification table
        $sql3 = mysqli_query($con, "DELETE FROM notifications WHERE sender_id = '$sender_id' AND receiver_id = '$logged_in' OR
        receiver_id = '$sender_id' AND sender_id = '$logged_in'");

        header("location: ../friends/request.php");
        

    }elseif(isset($_REQUEST['decline'])){



        $logged_in = $_SESSION['unique_id'];
        $sender_id = $_REQUEST['decline'];

        $sql4 = mysqli_query($con, "DELETE FROM notifications WHERE sender_id = '$sender_id' AND receiver_id = '$logged_in' OR
        receiver_id = '$sender_id' AND sender_id = '$logged_in'");

        header("location: ../friends/request.php");


    }elseif(isset($_REQUEST['unfollow'])){

        $logged_in = $_SESSION['unique_id'];
        $followed = $_REQUEST['unfollow'];

        $sql5 =  mysqli_query($con, "DELETE FROM followers WHERE followed_id = '$followed' AND following_id = '$logged_in' OR
        
            following_id = '$followed' AND followed_id = '$logged_in'");

        header("location: ../friends/friends_list.php");

    }elseif(isset($_POST['followed_id'])){

        // Coming From Ajax

        $followed = mysqli_real_escape_string($con, $_POST['followed_id']);
        $logged_in = $_SESSION['unique_id'];
    
        // Unfollow user
        $sql = mysqli_query($con, "DELETE FROM followers WHERE followed_id = '$followed' AND following_id = '$logged_in' OR
        
            following_id = '$followed' AND followed_id = '$logged_in'");
        $sql = mysqli_query($con, "DELETE FROM notifications WHERE sender_id = '$followed' AND receiver_id = '$logged_in' OR
        
            receiver_id = '$followed' AND sender_id = '$logged_in'");
    }
    
    



?>