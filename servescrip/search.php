<?php

    // Includes Database Connection
    include "../authentications/config_tdb.php";
       
    session_start();


    $search_value = mysqli_real_escape_string($con, $_POST['searchTerm']);
    $sql = mysqli_query($con, "SELECT * FROM users WHERE NOT unique_id = '{$_SESSION['unique_id']}' AND (f_name LIKE '%{$search_value}%' OR l_name LIKE '%{$search_value}%')");

    $result = "";

    if(mysqli_num_rows($sql) > 0){
        while($user_data = mysqli_fetch_assoc($sql)){

            $fullname = "{$user_data['f_name']} {$user_data['l_name']}";

            ?>
            <a href="chat.php?mbnau=<?php echo $user_data['unique_id'];?>"><div class="mobile-chats">
                <div class="mobile-chats-friends">
                    <div class="mobile-chats-profile-photo">
                    <?php 
                            if($user_data['profile_pic'] != ""){
                            ?>      
                                <img src="../profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                    <img src="../images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div>

                    <div class="mobile-chats-user-details">
                        <p><?php echo $fullname;?></p>

                        <?php 
                            // Fetch the previous message and display in the small tag below
                            $query = mysqli_query($con, "SELECT * FROM chat WHERE outgoing_msg_id = '{$_SESSION["unique_id"]}' AND incoming_msg_id = '{$user_data["unique_id"]}'
                            OR incoming_msg_id = '{$_SESSION["unique_id"]}' AND outgoing_msg_id = '{$user_data["unique_id"]}' ORDER BY msg_id DESC");

                            if(mysqli_num_rows($query) > 0){
                               $fetch_pre_msg = mysqli_fetch_assoc($query);
                               $last_msg_id = $fetch_pre_msg['outgoing_msg_id'];
                               $last_msg =  $fetch_pre_msg['msg'];

                               if(strlen($last_msg) > 26){
                                  $last_msg = substr($last_msg, 0, 26).'....';
                               }

                               if($user_data['unique_id'] == $last_msg_id){
                                    $last_msg = "<b>$last_msg</b>";
                               }else{
                                   $last_msg = "You: " . $last_msg;
                               }

                            }else{
                                $last_msg = "<i>Start a chat...</i>";
                            }
                        ?>

                        <small><?php echo $last_msg; ?></small>


                    </div>
                </div>
                
                <div class="mobile-chats-online-status">
                    <span class="material-icons-sharp">circle</span>
                </div>
                </div>
            </a>
        <?php    
        }
    }else{
        $result = "<p style='padding: 0.5rem;'>search not found!</p>";
    }

    echo $result;

?>