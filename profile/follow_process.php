<?php

    session_start();

    // Includes 
    include "../authentications/config_tdb.php";

    $followed = mysqli_real_escape_string($con, $_POST['followed_id']);
    $logged_in = $_SESSION['unique_id'];

    // Check if the User On the Profile Page is same as the Logged In user
    if($followed == $logged_in){
        ?>

        <a href="update.php">
        <button type="button" class="profile-btn" style="display: flex; align-items: center; 
        justify-content: center;">Edit <span class="material-icons-sharp edit-icon" style="border: none; font-size: 1rem; 
        margin-left: 0.3rem;">edit</span>
        </button>
        </a>

    <?php
    }else{


        // Check if the Logged in user is following this profile
        $sql = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '$followed' AND following_id = '$logged_in' OR
        
            following_id = '$followed' AND followed_id = '$logged_in'");
        
        $row = mysqli_num_rows($sql);

        if($row > 0){
            ?>

            <button type="button" onclick="unfollow()" class="profile-btn-unfollow" style="display: flex; align-items: center; 
            justify-content: center; cursor: pointer;">unfollow <span class="material-icons-sharp edit-icon" style="border: none; font-size: 1rem; 
            margin-left: 0.3rem;">remove</span>
            </button>
        
        <?php
        }else{

            // Check if friend request has been sent and not yet confirmed
            $sql2 = mysqli_query($con, "SELECT * FROM notifications WHERE notification_content = 'Sent a friend request' AND sender_id = '$logged_in' AND receiver_id = '$followed' OR sender_id = '$followed' AND receiver_Id = '$logged_in'");
            
            $row = mysqli_num_rows($sql2);

            if($row > 0){
                            
                            

                ?>

                <button type="button" onclick="cancle_request()" class="profile-btn-follow" style="display: flex; align-items: center; 
                justify-content: center; cursor: pointer;">cancel request</button>

            <?php
            }else{
                ?>

                <button type="button" onclick="follow()" class="profile-btn-follow" style="display: flex; align-items: center; 
                justify-content: center; cursor: pointer;">Follow <span class="material-icons-sharp edit-icon" style="border: none; font-size: 1rem; 
                margin-left: 0.3rem;">add</span>
                </button>
        
            <?php
        }
    }

    }

?>