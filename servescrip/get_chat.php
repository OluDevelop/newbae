<?php
session_start();
// Includes Database Connection
include "../authentications/config_tdb.php";

if(isset($_SESSION['unique_id'])){

    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);    
    $output_msg = "";

    // Check if the session user is a friend with the visitor's account
    $sql_check = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '{$_SESSION['unique_id']}' AND following_id = '$incoming_id' OR
    
        followed_id = '$incoming_id' AND following_id =  '{$_SESSION['unique_id']}'");

    $row = mysqli_num_rows($sql_check);

    if($row > 0){
        $sql = mysqli_query($con, "SELECT * FROM chat WHERE incoming_msg_id = '$incoming_id' AND outgoing_msg_id = '$outgoing_id' OR incoming_msg_id = '$outgoing_id' AND outgoing_msg_id = '$incoming_id' ORDER BY msg_id");

        if(mysqli_num_rows($sql) > 0){
            while($fetch = mysqli_fetch_assoc($sql)){
                if($fetch['outgoing_msg_id'] == $outgoing_id){
                    $output_msg .= '<div class="m-chat mobile-outgoing-chat">
                                    <div class="mobile-chat-details">
                                        <p>'. $fetch['msg'] .'</p>
                                    </div>
                                    </div>';
                }else{
                    $output_msg .= '<div class="m-chat mobile-incoming-chat">
                                    <img src="../images/profile-11.jpg" alt="">
                                    <div class="mobile-chat-details">
                                        <p>'. $fetch['msg'] .'</p>
                                    </div>
                                    </div>';
                }
                
            }
            echo $output_msg;
        }
    }else{
        
        $sql = mysqli_query($con, "SELECT * FROM msg_request WHERE incoming_msg_id = '$incoming_id' AND outgoing_msg_id = '$outgoing_id' OR incoming_msg_id = '$outgoing_id' AND outgoing_msg_id = '$incoming_id' ORDER BY msg_id");

        if(mysqli_num_rows($sql) > 0){
            while($fetch = mysqli_fetch_assoc($sql)){
                if($fetch['outgoing_msg_id'] == $outgoing_id){
                    $output_msg .= '<div class="m-chat mobile-outgoing-chat">
                                    <div class="mobile-chat-details">
                                        <p>'. $fetch['msg'] .'</p>
                                    </div>
                                    </div>';
                }else{
                    $output_msg .= '<div class="m-chat mobile-incoming-chat">
                                    <img src="../images/profile-11.jpg" alt="">
                                    <div class="mobile-chat-details">
                                        <p>'. $fetch['msg'] .'</p>
                                    </div>
                                    </div>';
                }
                
            }

            echo $output_msg;
            echo "<p style='text-align: center; line-height: 1.2rem; padding: 2rem'>You are not yet connected with this user. You are chatting as temporary friends.</p>";

        }

    }


   
}else{
    header("location: ../authentications/");
}

?>
