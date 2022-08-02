<?php
    include "../includes/auth_users.php";

    // Include DB
    include "../authentications/config_tdb.php";
    require ("../create_post/timefunction.php");

    // Update Red Dot notification Row to 1 is in URL red == 1
    $session_id = $_SESSION['unique_id'];
    if($_REQUEST['red'] == 1){
        
        // Update Red Dot Notification
        $redSql = mysqli_query($con, "UPDATE notifications SET red_dot_not = 1 WHERE receiver_id = '$session_id'");


    }


?>


<!-------- Include Header --------------->
<?php include "../includes/g_header.php" ?>

<body>
   
<!-------- Include Header --------------->
<?php include "../includes/mobile_page_header.php" ?>


<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>

<!-----------Include Mobile Nav Menu----------->
<?php include "../includes/nav_menu_mobile.php"?>


<div class="mobile-notifications">

    <?php
        // Fetch Notifications From the Notification Table
        $session_id = $_SESSION['unique_id'];
        $sql = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '$session_id' ORDER BY ID DESC");

        $row = mysqli_num_rows($sql);
        if($row < 1){
            echo "<p style=\"text-align: center\">You do not have notifications yet</p>";
        }

        while ($fetch_sql = mysqli_fetch_assoc($sql)){
            $sender_id = $fetch_sql['sender_id'];

            // Fetch Sender Details 
            $sql2 = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$sender_id'");
            $fetch_query = mysqli_fetch_assoc($sql2);

            $fullname = $fetch_query['f_name'] . " " . $fetch_query['l_name'];
            $period = $fetch_sql['timesent'];

            ?>

            <div class="notification-profile">
                <div class="notification-details">
                    <div class="notification-profile-photo">
                        <a href="../profile/?bup=<?php echo $sender_id?>&upd=0">
                        <?php if($fetch_query['profile_pic'] != ""){
                            ?>      
                                <img src="../profile/profile_photos/<?php echo $fetch_query['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                <img src="../images/avater.jpg" alt="">
                            <?php

                            }
                        ?>
                    </div>
                    <div class="notification-profile-name">
                        <h1><?php echo $fullname ?></h1></a>
                        <?php
                            // Check if the Notification content is Friend Request
                            if($fetch_sql['notification_content'] == 'Sent a friend request'){
                                $idsender = $fetch_sql['sender_id'];
                                $url = "../profile/?bup=$idsender&upd=1";
                            }elseif($fetch_sql['notification_content'] == 'Comment on your Post'){
                                $idpost = $fetch_sql['post_id'];
                                $idcomment = $fetch_sql['comment_id'];
                                $url = "../posts/?mbpc=$idpost&stat=1&all=0&ci=$idcomment&visit=$session_id";
                            }
                        ?>
                        <a href=<?php echo $url?>>
                            <p style="font-size: 1rem; margin-top: 0.4rem"><?php echo $fetch_sql['notification_content'] ?></p>

                            <p style="color: #899"><?php
                                // Check if the Notification Comment length is greater than 35
                                $not_comment = $fetch_sql['comment'];
                                if(strlen($not_comment) > 35){
                                    $comment = substr($not_comment, 0, 35)."...";
                                }else{
                                    $comment = $not_comment;
                                }
                                echo $comment;
                            ?></p>
                        <p style="color: #555"><?php echo time_posted($period) ?></p></a>
                    </div>
                    </div>

                    <div class="active-shape">
                        <?php 
                            // Check if the Notification has been clicked
                            if($fetch_sql['status'] == 0){
                                $color = "#31a264";
                            }else{
                                $color = "#555";
                            }
                        ?>
                        <div class="mobile-chats-online-status">
                            <span style="color: <?php echo $color ?>" class="material-icons-sharp">circle</span>
                        </div>
                    </div>
            </div>
    <?php
        }

    ?>

    
    
</div>


<script src="../newjs/accept_request.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>