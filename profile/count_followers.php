<?php
session_start();

    // Includes 
    include "../authentications/config_tdb.php";

    $logged_in = $_SESSION['unique_id'];
    $profile_id = $_POST['profile_id'];


    // Check if the Profile Visitors Id is same is the Profile URL ID
    if($logged_in == $profile_id){

        // Count Followers
        $sql = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '$logged_in' OR following_id = '$logged_in'");

        $row = mysqli_num_rows($sql);

        if($row > 0){
            echo $row;
        }else{
            echo "0";
        }
    }else{

        // Count the followers of the visitors profile
        $sql2 = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '$profile_id' OR following_id = '$profile_id'");
        
        $row2 = mysqli_num_rows($sql2);

        if($row2 > 0){
            echo $row2;
        }else{
            echo "0";
        }
    }

   


?>