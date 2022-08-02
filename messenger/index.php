<?php
    include "../includes/auth_users.php";
?>

<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>

<body>


<div class="mobile-message-head">

    <span class="material-icons-sharp" onclick="history.back()">keyboard_backspace</span>
    <p>Messaging</p>

</div>

<div class="mobile-message-search2">
    <span class="material-icons-sharp">search</span>
    <input type="search" placeholder="Search for a Friend...">
    <span onclick="msgReq()" class="material-icons-sharp msg_request">3p</span>
</div>

<!-- <div class="notice" style="background: #677DB6; line-height: 1.2rem; padding: 0.5rem">
    <p> <b style="color: black;">Developer's Notice: </b>Temporary Friends </p>
    </p>
</div> -->


<div class="mobile-message">

    <?php

        $logged_in = $_SESSION['unique_id'];

        // Fetch all the Friends Table
        $sql = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '$logged_in' OR following_id = '$logged_in' order by id");
        
        
        if($sql){
            while($user_data = mysqli_fetch_assoc($sql)){

                if($user_data['followed_id'] != $_SESSION['unique_id']){
                    $friends_id = $user_data['followed_id'];
    
                }elseif($user_data['followed_id'] == $_SESSION['unique_id']){
                    $friends_id = $user_data['following_id'];
                }
    
    
                $sql2 = mysqli_query($con, "SELECT * FROM `users` WHERE unique_id = '$friends_id' ORDER BY id");
    
                if($sql2){
                    $user_data = mysqli_fetch_assoc($sql2);
        
                }else{
                    echo "Failllled";
                }
    
                ?>
                <a href="chat.php?mbnau=<?php echo $user_data['unique_id'];?>"><div class="mobile-chats">
                    <div class="mobile-chats-friends">
                        <div class="mobile-chats-profile-photo">
                            <?php if($user_data['profile_pic'] != ""){
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
                            <p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p>
    
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
                                    $last_msg = "<i>start a conversation...</i>";
                                }
                            ?>
                            
                            <small><?php echo $last_msg; ?></small>
                        </div>
                        </div>
                
                        <?php 
                            // Check if user is online or offline
                            if($user_data['online_status'] == 'offline'){
                                $offline = 'offline';
                            }else{
                                $offline = "";
                            }
                        ?>
                        
                        <div class="mobile-chats-online-status">
                            <span class="material-icons-sharp <?php echo $offline;?>">circle</span>
                        </div>
                    </div>
                </a>
            <?php    
            }

        }else{
            echo "Failed";
        }

    ?>

    <div class="mobile-search-page-pop-up">
        <div class="mobile-message-search">
            <span class="material-icons-sharp">search</span>
            <input type="search" placeholder="start typing ...">
            <span onclick="closes()" style="cursor: pointer" class="material-icons-sharp">close</span>
        </div>

        <div class="mobile-search-result">
            
        </div>

    </div>

    <div class="mobile-search-page-pop-up-msg-request">
        <div class="mobile-message-search">
            <span class="material-icons-sharp">3p</span>
            <p style="width: 100%">Your message requests</p>
            <span onclick="closed()" style="cursor: pointer" class="material-icons-sharp">close</span>
        </div>

       <div class="msg-requests">

<?php

    $logged_in = $_SESSION['unique_id'];

    // Fetch all the Friends Table
    $sql4 = mysqli_query($con, "SELECT * FROM request_msg WHERE receiver_id = '$logged_in' order by id DESC");


    if($sql4){
        while($user_data = mysqli_fetch_assoc($sql4)){

            $friends_id = $user_data['sender_id'];

            $sql2 = mysqli_query($con, "SELECT * FROM `users` WHERE unique_id = '$friends_id' ORDER BY id");

            if($sql2){
                $user_data = mysqli_fetch_assoc($sql2);

            }else{
                echo "Failllled";
            }

            ?>
            <a href="chat.php?mbnau=<?php echo $user_data['unique_id'];?>"><div class="mobile-chats">
                <div class="mobile-chats-friends">
                    <div class="mobile-chats-profile-photo">
                        <img src="../images/profile-11.jpg" alt="">
                    </div>

                    <div class="mobile-chats-user-details">
                        <p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p>

                        <?php 
                            // Fetch the previous message and display in the small tag below
                            $query = mysqli_query($con, "SELECT * FROM msg_request WHERE outgoing_msg_id = '{$_SESSION["unique_id"]}' AND incoming_msg_id = '{$user_data["unique_id"]}'
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
                                $last_msg = "<i>start a conversation...</i>";
                            }
                        ?>
                        
                        <small><?php echo $last_msg; ?></small>
                    </div>
                    </div>
            
                    <?php 
                        // Check if user is online or offline
                        if($user_data['online_status'] == 'offline'){
                            $offline = 'offline';
                        }else{
                            $offline = "";
                        }
                    ?>
                    
                    <div class="mobile-chats-online-status">
                        <span class="material-icons-sharp <?php echo $offline;?>">circle</span>
                    </div>
                </div>
            </a>
        <?php    
        }

    }else{
        echo "Failed";
    }

?>

       </div>

    </div>
    
</div>

<!-----------------------Dark and Light Mode Actication----------------------->
<div id="dark-btn" style="display: none;">
    <span></span>
</div>

<script src="../javascript/script.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../newjs/search.js"></script>
</body>
</html>