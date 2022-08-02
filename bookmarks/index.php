<?php
    include "../includes/auth_users.php";

    // Include DB
    include "../authentications/config_tdb.php";
    require ("../create_post/timefunction.php");
?>

<!-------- Include Header --------------->
<?php include "../includes/g_header.php" ?>

<!-------- Include Header --------------->
<?php include "../includes/mobile_page_header.php" ?>


<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>
<body>


<div style="padding: 0.5rem; background: #555;">
    <img src="" alt="">
    
</div>


<?php // Post Based on Users Saved Bookmars ?>
    <?php
        $session_id = $_SESSION['unique_id'];

        // Fetch Post if Post unique_id == SESSION ID
        $sql_post = mysqli_query($con, "SELECT * FROM bookmarks WHERE unique_id = '$session_id' ORDER BY id DESC");

        while($post_fetch = mysqli_fetch_assoc($sql_post)){
        $post_unique_id = $post_fetch['unique_id'];
        $post_it_id = $post_fetch['post_id'];

        // Fetch Post Details
        $postD = mysqli_query($con, "SELECT * FROM posts WHERE post_id = $post_it_id");
        $sql_fetch = mysqli_fetch_assoc($postD);
        


        $post_post_time = strtotime($sql_fetch['timeposted']);
        $current_time = strtotime(date("Y-m-d h:i:sa"));
        $time_difference = $current_time - $post_post_time;

        // Fetch the user info from the users table
        $fetch_user_info = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$post_unique_id'");

        $fetch_details = mysqli_fetch_assoc($fetch_user_info);

        $user_fullname = $fetch_details['f_name'] . ' ' . $fetch_details['l_name']; 
        $user_profile_pic = $fetch_details['profile_pic'];
        
        $seconds = $time_difference;
        // if($seconds < 60){
            // echo $seconds;
            ?>
                <form action="" class="post_id_form">
                    <input type="text" name="id" value="<?php echo $post_it_id ?>" id="" hidden>
                </form>

                <div class="feed">
                    <div class="feed-head">

                        <?php // Start: Post Owner Profile ?>
                        <a href="profile/?bup=<?php echo $post_unique_id; ?>">
                            <div class="feed-user">
                                <div class="rounded-photo">
                                    <?php 
                                        if($fetch_details['profile_pic'] != ""){
                                        ?>      
                                            <img src="../profile/profile_photos/<?php echo $fetch_details['profile_pic'] ?>" alt="">
                                        <?php
                                        }else{
                                            ?>
                                                <img src="../images/avater.jpg" alt="">
                                        <?php
                                        }
                                    ?>
                                </div>
                                <div class="feed-user-name">
                                    <p><?php echo $user_fullname?></p>

                                    <?php
                                        $period = $sql_fetch['timeposted'];
                                    ?>

                                    <small><?php echo time_posted($period)?></small>
                                    <!-- <p id="notice_post" style="font-size: 0.8rem; color: grey">new post disappers in 60s</p> -->
                                    
                                </div>
                            </div>
                        </a>
                        <?php // End: Post Owner Profile ?>

                        <a href="#"><span class="material-icons-sharp">more_horiz</span></a>
                    </div>
                    
                    <?php // Start: Post Comments  ?>
                    <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $_SESSION['unique_id'] ?>">

                        <?php // Start: Post Text ?>

                        <div class="feed-text">
                            <p><?php echo $sql_fetch['post_text'];?></p>
                        </div>
                    </a>
                        <?php
                        
                            // Start: Post Img or Vid
                            if($sql_fetch['post_img'] != ''){
                                ?>
                                <div class="feed-img">
                                    <a href="../posts/?mbpc=<?php echo $sql_fetch['post_id']; ?>&&stat=1&all=0&ci=none&visit=<?php echo $_SESSION['unique_id'] ?>">
                                        <img src="../create_post/images/<?php echo $sql_fetch['post_img'] ?>" alt="">
                                    </a>
                                </div>
                            <?php
                            
                            }elseif($sql_fetch['post_vid'] != ''){
                                ?>
                                <div class="feed-img">
                                    <div style="position: relative; display: inline-block" class="overlayVid">
                                        <img style="position: absolute; z-index: 2; margin: 0 auto; left: 0; right: 0; top: 40%; text-align: center; width: 60%; color: white; 
                                        font-weight: 600; text-transform: capitalize; font-size: 2rem; cursor: pointer; width: 70px;" 
                                        class="playImage" onclick="playBtn()" src="images/play.png" alt="">
                                        <video onclick="pauseBtn()" class="uploadVid" width="100%" height="100%">
                                            <source src="../create_post/videos/<?php echo $sql_fetch['post_vid'] ?>" type="video/mp4">
                                            <source src="../create_post/videos/<?php echo $sql_fetch['post_vid'] ?>" type="video/ogg">
                                            Your Browser Does Not Support the Video Tag
                                        </video>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                
                    <?php // Start: Post Reactions ?>
                    <div class="feed-actions">
                        <div class="feed-action">
                            <div class="feed-span">
                                <span class="material-icons-sharp like_icon">favorite_border</span>
                                <p id="like_count"></p>

                                <form action="" id="likeForm">
                                    <input type="text" name="unique_id" class="session_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                                    <input type="text" name="post_id" id="post_id" value="<?php echo $post_id?>" hidden>
                                </form>
                            </div>

                            <div class="feed-span">
                            <!-- Button for Post reactions pop up -->
                            <a href="posts/?mbpc=<?php echo $post_fetch['post_id'];?>&stat=none&visit=<?php echo $session_id ?>"><span class="material-icons-sharp">maps_ugc</span></a>
                                <p>

                                    <?php 
                                        // Fetch numbers of comment
                                        $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$sql_fetch['post_id']}' AND comment != ''");
                                        
                                        $comment_row = mysqli_num_rows($sql_reactions);

                                        echo $comment_row;
                                    
                                    ?>
                                </p>
                            </div>

                            <div class="feed-span">
                                <span class="material-icons-sharp">share</span>
                                <p>6</p>
                            </div>
                        </div>
                    </div>
                    <div class="liked-by">
                        <img src="../images/profile-4.jpg" alt="">
                        <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p>
                    </div>
                </div>

         <?php

        }
    ?>





<!---------- Include Mobile Nav Menu ----------->
<?php include "../includes/nav_menu_mobile.php" ?>


<script src="../newjs/accept_request.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>

