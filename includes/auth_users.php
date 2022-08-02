<?php

// Includes 
include "../authentications/config_tdb.php";

// Start Session
session_start();

if($_SESSION['unique_id']){

    // Fetch User Data
    $unique_id = $_SESSION['unique_id'];
    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `unique_id` = '$unique_id'");

    if(mysqli_num_rows($sql) == 1){
        $user_data = mysqli_fetch_assoc($sql);

        $f_name = $user_data['f_name'];
        $l_name = $user_data['l_name'];

        $fullname = "{$user_data['f_name']} {$user_data['l_name']}";
    }

}else{
    header("location: ../authentications");
}

?>