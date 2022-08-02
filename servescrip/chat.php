<?php
session_start();
// Includes Database Connection
include "../authentications/config_tdb.php";

if(isset($_SESSION['unique_id'])){

    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $message = htmlentities($message);


    // Check if the sender user is a friend of the receiver

    $sql_check = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '{$_SESSION['unique_id']}' AND following_id = '$incoming_id' OR
    
        followed_id = '$incoming_id' AND following_id =  '{$_SESSION['unique_id']}'");

    $row = mysqli_num_rows($sql_check);


    if($row > 0){
        // Insert into Database
        $sql = mysqli_query($con, "INSERT INTO `chat` (`incoming_msg_id`, `outgoing_msg_id`, `msg`) 
        VALUES ('$incoming_id', '$outgoing_id', '$message')");

    }else{
        // Insert into message request table
        $sql_insert = mysqli_query($con, "INSERT INTO `msg_request` (`incoming_msg_id`, `outgoing_msg_id`, `msg`) 
            VALUES ('$incoming_id', '$outgoing_id', '$message')");

        // Check if the sender id has sent a message to the receiver id
        $query = mysqli_query($con, "SELECT * FROM request_msg WHERE sender_id = '$outgoing_id' AND receiver_id = '$incoming_id' 
            OR sender_id = '$incoming_id' AND receiver_id = '$outgoing_id'");

        $row = mysqli_num_rows($query);

        if($row < 1){
            //Insert the users into the temp_request table
            $sql_insert2 = mysqli_query($con, "INSERT INTO request_msg (sender_id, receiver_id) VALUES ('$outgoing_id', '$incoming_id')");
        }

        
    }

}else{
    header("location: ../authentications/");
}

?>
