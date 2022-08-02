<?php
    include "../includes/auth_users.php";

    // Include DB
    include "../authentications/config_tdb.php";
?>

<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>
<body>


<!-------------Include Desktop Nav------------->
<?php include "../includes/desktop_nav.php"?>

<!-------------Include Mobile Page Header------------->
<?php include "../includes/mobile_page_header.php"?>


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
        <span class="material-icons-sharp active">diversity_1</span>
    </div></a>
    <a href="request.php">
    <div class="option1">
        <span class="material-icons-sharp">group_add</span>
    </div></a>
</div> -->

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

        <a href="friends_list.php"><div class="friends-left-head-lists active">
            <div>
                <span class="material-icons-sharp">diversity_1</span>
                <p>Your Friends</p>
            </div>
            <span class="material-icons-sharp hide">chevron_right</span>
        </div></a>

        <a href="request.php"><div class="friends-left-head-lists">
            <div>
                <span class="material-icons-sharp">group_add</span>
                <p>Friend Requests</p>
            </div>
            <span class="material-icons-sharp hide">chevron_right</span>
        </div></a>

    </div>

    <div class="friends-right mobile-hide">
        
        <div class="friends-right-head">
            <h1>Your Connections</h1>
        </div>
        <div class="friends-right-all-cards">

        <?php

        // Fetch all the Friends Table
        $sql = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '{$_SESSION['unique_id']}' OR following_id = '{$_SESSION['unique_id']}' ORDER BY f_name ASC, l_name ASC");

        $row = mysqli_num_rows($sql);

        if($row < 1){
            echo '<small style="display: flex; justify-content: center;">You do not have friends. Search for a friend';
        }

        while($user_data = mysqli_fetch_assoc($sql)){

            if($user_data['followed_id'] != $_SESSION['unique_id']){
                $friends_id = $user_data['followed_id'];

            }elseif($user_data['followed_id'] == $_SESSION['unique_id']){
                $friends_id = $user_data['following_id'];
            }

            $sql2 = mysqli_query($con, "SELECT * FROM `users` WHERE unique_id = '$friends_id' ORDER BY id");

            if($sql2){
                $user_data = mysqli_fetch_assoc($sql2);
            }

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
                        <h1>Mercy Peace</h1>
                        <p>6 mutual friends</p>
                        <button type="button" class="friends-card-btn">Unfollow</button>
                        <button type="button" class="msg-btn">Message</button>
                        
                    </div>
                </center>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="friends-right-mobile">
        
        <div class="switch_btw_friends">
            <label><a href="index.php">Suggested</a></label>
            <label><a href="request.php">Requests</a></label>
        </div>

        <div class="friends-right-head">
            <h1>Your Connections</h1>
        </div>

        <?php

            // Fetch all the Friends Table
            $sql = mysqli_query($con, "SELECT * FROM followers WHERE followed_id = '{$_SESSION['unique_id']}' OR following_id = '{$_SESSION['unique_id']}' ORDER BY f_name ASC, l_name ASC");
        
            $row = mysqli_num_rows($sql);

            if($row < 1){
                echo '<small style="display: flex; justify-content: center;">You do not have friends. Search for a friend';
            }

            while($user_data = mysqli_fetch_assoc($sql)){
    
                if($user_data['followed_id'] != $_SESSION['unique_id']){
                    $friends_id = $user_data['followed_id'];
    
                }elseif($user_data['followed_id'] == $_SESSION['unique_id']){
                    $friends_id = $user_data['following_id'];
                }
    
                $sql2 = mysqli_query($con, "SELECT * FROM `users` WHERE unique_id = '$friends_id' ORDER BY id");
    
                if($sql2){
                    $user_data = mysqli_fetch_assoc($sql2);
                }
    
                ?>
        
                    <div class="friends-right-lists">
                        <div class="friends-right-lists-group">
                            <a href="../profile/?bup=<?php echo $user_data['unique_id']?>">
                                <div class="friends-right-lists-photo">

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
                            </a>
                            <div class="friends-right-lists-texts">
                                <div>
                                    <p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p>
                                </div>
                                <div>
                                    <small>5 mutual friends</small>
                                </div>
                                <button type="button" class="msg-btn">Message</button>
                            </div>
                        </div>
                        <a href="../profile/unfollow_user.php?unfollow=<?php echo $user_data['unique_id'] ?>"><button type="button" class="friends-card-btn">Unfollow</button></a>
                    </div>


            <?php
            }
        ?>



    </div>


    <div class="friends-right-pop-up">
        <div class="friends-right-confirm-pop-up" onclick="launchPopUp()">
            <h1>Confirm Unfollow</h1>
            <div class="buttons">
                <a href="../profile/unfollow_user.php?unfollow=<?php echo $user_data['unique_id'] ?>"><button type="button" class="confirm-btn">Confirm</button></a>
                <button type="button" class="confirm-btn color-danger" onclick="cancel()">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>

<!-----------Include Mobile Nav Menu----------->
<?php include "../includes/nav_menu_mobile.php"?>

<!-----------Include Desktop Notification Pop----------->
<?php include "../includes/desktop_notification_pop.php"?>


<script src="../newjs/focus.js"></script>
<script src="../javascript/confirm.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/mobile-top-options-close.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>