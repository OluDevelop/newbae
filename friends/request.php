<?php
    include "../includes/auth_users.php";
?>

<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>
<body>

<!-------------- Include Desktop Nav --------------->
<?php include "../includes/desktop_nav.php" ?>


<!---------------- Include Mobile Page Header --------------->
<?php include "../includes/mobile_page_header.php" ?>



<div class="friends">
    <div class="friends-left">
        <div class="friends-left-head">
            <h1>Friends</h1>
            <div class="friends-left-head-profile-img">
                <img src="../images/avater.jpg" alt="">
            </div>
        </div>

        <a href="../friends"><div class="friends-left-head-lists">
            <div>
                <span class="material-icons-sharp">diversity_3</span>
                <p>Suggested Friends</p>
            </div>
            <span class="material-icons-sharp hide">chevron_right</span>
        </div></a>
        
        <a href="friends_list.php"><div class="friends-left-head-lists">
            <div>
                <span class="material-icons-sharp">diversity_1</span>
                <p>Your Friends</p>
            </div>
            <span class="material-icons-sharp hide">chevron_right</span>
        </div></a>
        
        <a href="request.php"><div class="friends-left-head-lists active">
            <div>
                <span class="material-icons-sharp">group_add</span>
                <p>Friend Requests</p>
            </div>
            <span class="material-icons-sharp hide">chevron_right</span>
        </div></a>

    </div>

    <div class="friends-right">

        <div class="switch_btw_friends">
            <label><a href="index.php">Suggested</a></label>
            <label><a href="friends_list.php">Connections</a></label>
        </div>
        
        <div class="friends-right-head">
            <h1>Accept or Decline Requests</h1>
        </div>

        <div class="friends-right-all-cards">
        <?php

        // Fetch All Notification from the Notification Table
        $sql = mysqli_query($con, "SELECT * FROM notifications WHERE notification_content = 'Sent a friend request' AND receiver_id = '{$_SESSION["unique_id"]}' AND status != '1' ORDER BY id DESC");

        $rows = mysqli_num_rows($sql);

        // Fetch Friend Requests
        if($rows < 1){
            echo '<small style="text-align: center; display: flex; justify-content: center"> You do not have friend requests</small>';
        }else{

        
        while ($user_data2 = mysqli_fetch_assoc($sql)) {

            $sender = $user_data2['sender_id'];

            // Fetch the Sender Profile Details from the Users Table
            $sql2 = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$sender'");

            $user_data = mysqli_fetch_assoc($sql2);

            ?>
            <div class="friends-right-cards">
                <div class="friends-right-cards-wall-photo">
                    <?php 
                        if($user_data['cover_photo'] != ""){
                            ?>
                                <img src="../profile/cover_photos/<?php echo $user_data['cover_photo'] ?>" alt="">

                        <?php
                        }else{
                            ?>
                                <img src="../images/cover.jpg" alt="">
                        <?php
                        }
                    ?>
                </div>
                <center>
                    <div class="friends-right-cards-profile-photo">
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
                    <div class="friends-right-cards-texts">
                        <h1><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name']; ?></h1>
                        <p>6 mutual friends</p>

                        <?php
                            // Check if the both are connected to each other
                            $sql3 = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '{$user_data["unique_id"]}' AND following_id = '{$_SESSION["unique_id"]}'
                            
                                OR followed_id = '{$_SESSION["unique_id"]}' AND following_id = '{$user_data["unique_id"]}'");

                            $row = mysqli_num_rows($sql3);
                            
                            if($row > 0){
                                ?>
                                    <a href="../profile/unfollow_user.php?source=<?php echo $sender ?>"><button style="margin-top: 0.3rem" type="button" class="friends-card-btn">unfriend</button></a>
                            <?php
                            }else{
                                ?>
                                    <a href="../profile/accept_request.php?source=frequest&bup=<?php echo $user_data['unique_id'];?>"><button type="button" class="friends-card-btn">Accept</button></a>
                                    <a href="../profile/unfollow_user.php?decline=<?php echo $sender ?>"><button style="margin-top: 0.3rem" type="button" class="friends-card-btn">Decline</button></a>
                            <?php
                            }
                        ?>

                        
                    </div>
                </center>
            </div>

        <?php
        }
            
        }
        
        ?>
        </div>
    </div>
</div>


</div>

</div>


<!---------------------Mobile Friends Top Options--------------------->
<!-- <div class="mobile-top-options">
    <span class="material-icons-sharp last off" onclick="openTopOption()">chevron_left</span>
    <span class="material-icons-sharp last" onclick="closeTopOption()">chevron_right</span>
    <a href="../friends">
        <div class="option1">
        <span class="material-icons-sharp">diversity_3</span>
    </div></a>
    <a href="friends_list.php">
    <div class="option1">
        <span class="material-icons-sharp">diversity_1</span>
    </div></a>
    <a href="request.php">
    <div class="option1">
        <span class="material-icons-sharp active">group_add</span>
    </div></a>
</div> -->

<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>

<!-----------Include Mobile Nav Menu----------->
<?php include "../includes/nav_menu_mobile.php"?>

<!-----------Include Desktop Notification Pop----------->
<?php include "../includes/desktop_notification_pop.php"?>



<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/mobile-top-options-close.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>