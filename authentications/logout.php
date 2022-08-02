<?php

    // Includes 
    include "../authentications/config_tdb.php";
    session_start();

    $ID = $_SESSION['unique_id'];

    // Update user's online_status
    $sql = mysqli_query($con, "UPDATE users SET online_status = 'offline' WHERE unique_id =  '$ID'");
    
    if($sql){
        session_unset();
        session_destroy();
        header("Location: ../authentications");
    }else{
        echo "Failed";
    }

    

    


?>