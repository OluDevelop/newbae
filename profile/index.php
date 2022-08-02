<?php
    include "../includes/auth_users.php";
    include "process_update.php";
    require("../create_post/timefunction.php");

    // Includes 
    include "../authentications/config_tdb.php";

    // Check if there is a unique ID in the URL
    if($_REQUEST['bup']){

        $unique_id = mysqli_real_escape_string($con, $_REQUEST['bup']);

        $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$unique_id'");

        if($sql){
            $user_data = mysqli_fetch_assoc($sql);
            $fullname = $user_data['f_name'] . ' ' . $user_data['l_name'];
        }

        if($_REQUEST['upd'] == 1){
            // Update the Red Dot Notification Row
            $redSql = mysqli_query($con, "UPDATE notifications SET `status` = 1 WHERE receiver_id = '{$_SESSION['unique_id']}' AND notification_content = 'Sent a friend request'");
        }

    }else{
        header("Location: ../");
    }

    

?>

<!-------- Include Header --------------->
<?php include "../includes/g_header.php" ?>

<body>

<!-------------Include Desktop Nav------------->
<?php include "../includes/desktop_nav.php"?>


<!---------------===============User Profile Page For Mobile---------------=============-->
<div class="user-profile-page">
    <div class="user-profile-head">
        <span class="material-icons-sharp" onclick="history.back()">west</span>
        <div>
    
            <h1><?php echo $fullname;?></h1>
        </div>
    </div>

    <div class="user-profile-profile-top">
        <div class="user-profile-profile-top-photo">
            
                <?php if($user_data['cover_photo'] != ""){
                    ?>
                        <img src="cover_photos/<?php echo $user_data['cover_photo'] ?>" alt="">
                <?php
                }else{
                    ?>
                        <img src="../images/cover.jpg" alt="">
                <?php
                }
                ?>
        </div>

        <div class="user-profile-profile-top-details">
            <div class="user-profile-profile-top-details-top">
                <div class="user-profile-profile-top-details-photo">

                    <?php if($user_data['profile_pic'] != ""){
                    ?>      
                        <img src="profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                    <?php
                    }else{
                        ?>
                            <img src="../images/avater.jpg" alt="">
                    <?php
                    }
                    ?>

                </div>
                <div class="user-profile-profile-top-details-photo-icons">


                    <?php 

                        if($unique_id != $_SESSION['unique_id']){
                            ?>
                                <span class="material-icons-sharp" onclick="openProfileAction()">more_horiz</span>
                        <?php
                        }

                    ?>

                   <!-- Button for Follow or Edit Profile -->

                   <input type="text" name="followed_id" class="followed_id" value="<?php echo $unique_id;?>" hidden>

                   <div class="profile-action-btn">
                       
                   </div>

                   <!-- End of Button for Follow or Edit Profile -->


                </div>
            </div>

            <div class="user-profile-profile-top-details-texts">
                <div class="user-name">

                    <?php
                        // Check if update fields are still left
                        if($unique_id == $_SESSION['unique_id']){
                            if(empty($user_data['location']) || empty($user_data['marital_status']) || empty($user_data['occupation']) || empty($user_data['bio'])){
                                echo '<small style="color: red; line-height: 0.4rem">Complete your profile update</small>';
                            }
                        }
                    ?>

                    <h1><?php echo $fullname;?></h1>
                    <small>--<?php

                    if($unique_id == $_SESSION['unique_id']){
                        if($user_data['occupation'] == ""){
                            echo "Add your work place";
                        }else{
                            echo $user_data['occupation'];
                        }
                    }else{
                        echo $user_data['occupation'];
                    }
                    ?></small>
                </div>
                <div class="user-bio">
                    <?php
                        // Check if the user has not update his bio
                        if($unique_id == $_SESSION['unique_id']){
                            if($user_data['bio'] == ""){
                                echo "<small style='color: red;'>Click on the edit button to add a Bio</small>";
                            }else{
                                echo '<p>' . $user_data['bio'] . '</p>';
                            }
                        }else{
                            if($user_data['bio'] == ""){
                                echo "--";
                            }else{
                                echo $user_data['bio'];
                            }
                        }

                    ?>
                </div>
                <div class="user-followers-info">
                    <div>   
                        <!-- Send the current profile ID -->
                        <input type="text" name="profile_id" class="profile_id" value="<?php echo $unique_id ?>" hidden>
                        <small style="cursor: pointer"><b class="followers_class"> </b> Connect</small>
                    </div>
                    <div>
                        <div class="info-flex">
                            <div class="occupation">
                                <span class="material-icons-sharp">work_outline</span>--<?php 
                                if($unique_id == $_SESSION['unique_id']){
                                    if($user_data['occupation'] == ""){
                                        echo "Add your work place";
                                    }else{
                                        echo $user_data['occupation'];
                                    }
                                }else{
                                    if($user_data['occupation'] == ""){
                                        echo " ";
                                    }else{
                                        echo $user_data['occupation'];
                                    }
                                }
                                ?></small>
                            </div>
                            <div class="status">
                                <span class="material-icons-sharp">favorite_border</span>
                                <small><?php 
                                if($unique_id == $_SESSION['unique_id']){
                                    if($user_data['marital_status'] == ""){
                                        echo "Add marital status";
                                    }else{
                                        echo $user_data['marital_status'];
                                    }
                                }else{
                                    if($user_data['marital_status'] == ""){
                                        echo "--";
                                    }else{
                                        echo $user_data['marital_status'];
                                    }
                                }
                                ?></small>
                            </div>
                            <div class="location">
                                <span class="material-icons-sharp">place</span>
                                <small><?php 
                                if($unique_id == $_SESSION['unique_id']){
                                    if($user_data['location'] == ""){
                                        echo "Add your location";
                                    }else{
                                        echo $user_data['location'];
                                    }
                                }else{
                                    if($user_data['location'] == ""){
                                        echo "--";
                                    }else{
                                        echo $user_data['location'];
                                    }
                                }
                                ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 

                    if($unique_id != $_SESSION['unique_id']){
                        ?>
                        <button class="profile-msg-btn" type="button">Message</button>
                    <?php
                    }

                ?>

            </div>
            <p><b>
                <?php 
                    if($unique_id == $_SESSION['unique_id']){
                        echo "Your";
                    }else{
                        echo $fullname; 
                    }
                ?>
            </b> Activities</p>

        </div>
    </div>


    <?php // Post Based on Logged in User ?>
        <?php 
            // Feed Based on the logged user Post not less than 30sec 
            $session_id = $_SESSION['unique_id'];

            // Fetch Post if Post unique_id == SESSION ID
            if($unique_id == $session_id){
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$session_id' ORDER BY id DESC");
            }else{
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$unique_id' ORDER BY id DESC");
            }

            while($post_fetch = mysqli_fetch_assoc($sql_post)){
            $post_unique_id = $post_fetch['unique_id'];
            $post_id_new = $post_fetch['post_id'];

            // Fetch the user info from the users table
            $fetch_user_info = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$post_unique_id'");

            $fetch_details = mysqli_fetch_assoc($fetch_user_info);

            $user_fullname = $fetch_details['f_name'] . ' ' . $fetch_details['l_name']; 
            $user_profile_pic = $fetch_details['profile_pic'];

            //Fetch Comment ID to be passed into the URL
            $sql_id = mysqli_query($con, "SELECT * FROM notifications WHERE post_id = '$post_id_new' AND receiver_id = '$session_id'");
            $id = mysqli_fetch_assoc($sql_id);
            $comment_id = 'update_all';
            
            ?>

                <div class="feed">
                    <div class="feed-head">

                        <?php // Start: Post Owner Profile ?>
                        <a href="?bup=<?php echo $post_unique_id; ?>">
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
                                        $period = $post_fetch['timeposted'];
                                    ?>

                                    <small><?php echo time_posted($period)?></small>

                                </div>
                            </div>
                        </a>
                        <?php // End: Post Owner Profile ?>

                        <a href="#"><span class="material-icons-sharp">more_horiz</span></a>
                    </div>
                    
                    <?php // Start: Post Comments  ?>

                    <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=true&ci=<?php echo $comment_id ?>&visit=<?php echo $session_id ?>">

                        <?php // Start: Post Text ?>

                        <div class="feed-text">
                            <p><?php echo $post_fetch['post_text'];?></p>
                        </div>
                    </a>
                        <?php 
                        // Start: Post Img or Vid
                        if($post_fetch['post_img'] != ''){
                            ?>
                            <div class="feed-img">
                                <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $_SESSION['unique_id'] ?>">
                                    <img src="../create_post/images/<?php echo $post_fetch['post_img'] ?>" alt="">
                                </a>
                            </div>
                        <?php
                        
                        }elseif($post_fetch['post_vid'] != ''){
                            ?>
                            <div class="feed-img">
                                <div style="position: relative; display: inline-block" class="overlayVid">
                                    
                                    <video controls class="uploadVid" width="100%" height="100%">
                                        <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/mp4">
                                        <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/ogg">
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
                            <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=true&ci=<?php echo $comment_id ?>&visit=<?php echo $session_id ?>"><span class="material-icons-sharp">maps_ugc</span></a>
                                <p>

                                    <?php 
                                        // Fetch numbers of comment
                                        $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$post_fetch['post_id']}' AND comment != ''");
                                        
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
                    <!--<div class="liked-by">-->
                    <!--    <img src="../images/profile-4.jpg" alt="">-->
                    <!--    <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p>-->
                    <!--</div>-->
                    <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=true&ci=<?php echo $comment_id ?>&visit=<?php echo $session_id ?>"" style="color: #677db6;">
                        <?php
                            if($comment_row > 0){
                                echo '<small>View all comments</small>';
                            }
                        ?>
                            </a>
                </div>

        <?php

            }
        ?>
    

    <div class="user-profile-page-action">
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">content_copy</span>
            <p>Copy link to profile</p>
        </div>
        <a href="../messenger/chat.php?mbnau=<?php echo $user_data['unique_id'];?>"><div class="user-profile-action-icons">
            <span class="material-icons-sharp">message</span>
            <p>Message</p>
        </div></a>
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">remove_circle_outline</span>
            <p>Block <b style="color: rgb(221, 62, 62);"><?php echo $fullname?></b></p>
        </div>
        <div class="user-profile-action-icons">
            <button type="button" class="action-btn" onclick="closeProfile()">Close</button>
        </div>
    </div>

</div>



<!------------=================User Profile Page For Desktop-----------================-->
<div class="desktop-user-profile-page">  
    <div class="desktop-user-profile-page-head">
        <div class="desktop-user-profile-page-head-photo">
                <?php if($user_data['cover_photo'] != ""){
                    ?>
                        <img src="cover_photos/<?php echo $user_data['cover_photo'] ?>" alt="">
                <?php
                }else{
                    ?>
                        <img src="../images/cover.jpg" alt="">
                <?php
                }
                ?>
        </div>
        <div class="desktop-user-profile-container">
            <div class="desktop-user-profile-page-head-info">
                <div class="desktop-user-profile-page-head-user-info">
                    <div class="desktop-user-profile-page-head-info-profile-pic">
                        <?php if($user_data['profile_pic'] != ""){
                            ?>      
                                <img src="profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                    <img src="../images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div>
                    <div class="desktop-user-profile-user-info-details">
                        <h1><?php echo $fullname; ?></h1>
                        <?php
                            if($unique_id == $_SESSION['unique_id']){
                                if($user_data['occupation'] == ""){
                                    echo "Add your work place";
                                }else{
                                    echo $user_data['occupation'];
                                }
                            }else{
                                echo $user_data['occupation'];
                            }
                        ?>
                    </div>
                </div>
                <div class="desktop-user-profile-page-head-info-profile-icon">
                    <span class="material-icons-sharp">more_horiz</span>

                    <!-- Button for Follow or Edit Profile -->

                   <input type="text" name="followed_id" class="followed_id" value="<?php echo $unique_id;?>" hidden>
                   
                    <div class="profile-action-btn-desktop">
                        
                    </div>

                    <!-- End of Button for Follow or Edit Profile -->
                </div>
            </div>
        </div>
    </div>
    <div class="desktop-user-profile-container-flex">
        <div class="desktop-user-profile-container-flex-left">
            <div class="desktop-user-profile-container-flex-left-about">
                <h1>About <?php echo $fullname;?></h1>
            </div>
            <div class="user-followers-info">
                <div class="info-flex">
                    <div class="occupation">
                        <span class="material-icons-sharp">work_outline</span>
                        <?php
                            if($unique_id == $_SESSION['unique_id']){
                                if($user_data['occupation'] == ""){
                                    echo "Add your work place";
                                }else{
                                    echo $user_data['occupation'];
                                }
                            }else{
                                echo $user_data['occupation'];
                            }
                        ?>
                    </small>
                    </div>
                    
                    <div class="status">
                        <span class="material-icons-sharp">favorite_border</span>
                        <small>
                            <?php
                                if($unique_id == $_SESSION['unique_id']){
                                    if($user_data['marital_status'] == ""){
                                        echo "Add marital status";
                                    }else{
                                        echo $user_data['marital_status'];
                                    }
                                }else{
                                    if($user_data['marital_status'] == ""){
                                        echo "--";
                                    }else{
                                        echo $user_data['marital_status'];
                                    }
                                }
                            ?>
                        </small>
                    </div>

                    <div class="location">
                        <span class="material-icons-sharp">place</span>
                        <small>

                            <?php
                                if($unique_id == $_SESSION['unique_id']){
                                    if($user_data['location'] == ""){
                                        echo "Add your location";
                                    }else{
                                        echo $user_data['location'];
                                    }
                                }else{
                                    if($user_data['location'] == ""){
                                        echo "--";
                                    }else{
                                        echo $user_data['location'];
                                    }
                                }
                            ?>

                        </small>
                    </div>

                    <!-- <div class="mutual">
                        <span class="material-icons-sharp">diversity_3</span>
                        <small>5 mutual friends</small>
                    </div>
                    <div class="mutual">
                        <span class="material-icons-sharp">people</span>
                        <small>Friends</small>
                    </div>
                    <div class="mutual">
                        <span class="material-icons-sharp">wifi</span>
                        <small><b>500+</b> followers</small>
                    </div> -->
                </div>
            </div>
            <div class="desktop-user-profile-container-flex-left-about">
                <h1>BIO</h1>
            </div>
            <p>
                <?php
                    // Check if the user has not update his bio
                    if($unique_id == $_SESSION['unique_id']){
                        if($user_data['bio'] == ""){
                            echo "<small style='color: red;'>Click on the edit button to add a Bio</small>";
                        }else{
                            echo '<p>' . $user_data['bio'] . '</p>';
                        }
                    }else{
                        if($user_data['bio'] == ""){
                            echo "--";
                        }else{
                            echo $user_data['bio'];
                        }
                    }
                    ?>
                </p>           
            <button class="profile-msg-btn" type="button" style="display: flex; align-items: center; justify-content: center;"><span class="material-icons-sharp">message </span> Message</button>

        </div>
        <div style="padding-top: 1rem" class="desktop-user-profile-container-flex-right">
            <?php 
            // Fetch Post if Post unique_id == SESSION ID
            if($unique_id == $session_id){
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$session_id' ORDER BY id DESC");
            }else{
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$unique_id' ORDER BY id DESC");
            }

            $count_post = mysqli_num_rows($sql_post);

            if($unique_id == $_SESSION['unique_id']){
                if($count_post < 1){
                    $count_posts = "You have not created any post yet";
                }else{
                    $count_posts = "";
                }
            }else{
                if($count_post < 1){
                    $count_posts = "No created post yet";
                }else{
                    $count_posts = "";
                }
            }
            
            ?>

            <p style="text-align: center"><?php echo $count_posts ?></p>        
                
        <?php // Post Based on Logged in User ?>
        <?php 
            // Feed Based on the logged user 
            $session_id = $_SESSION['unique_id'];

            // Fetch Post if Post unique_id == SESSION ID
            if($unique_id == $session_id){
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$session_id' ORDER BY id DESC");
            }else{
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$unique_id' ORDER BY id DESC");
            }

            $count_post = mysqli_num_rows($sql_post);
            if($count_post < 1){
                $count_post = "No post made yet";
            }

            while($post_fetch = mysqli_fetch_assoc($sql_post)){
            $post_unique_id = $post_fetch['unique_id'];

            // Fetch the user info from the users table
            $fetch_user_info = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$post_unique_id'");

            $fetch_details = mysqli_fetch_assoc($fetch_user_info);

            $user_fullname = $fetch_details['f_name'] . ' ' . $fetch_details['l_name']; 
            $user_profile_pic = $fetch_details['profile_pic'];

            ?>
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
                                        $period = $post_fetch['timeposted'];
                                    ?>

                                    <small><?php echo time_posted($period)?></small>

                                </div>
                            </div>
                        </a>
                        <?php // End: Post Owner Profile ?>

                        <a href="#"><span class="material-icons-sharp">more_horiz</span></a>
                    </div>
                    
                    <?php // Start: Post Comments  ?>
                    <a href="../posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=true&ci=<?php echo $comment_id ?>&visit=<?php echo $session_id ?>">

                        <?php // Start: Post Text ?>
                        <div class="feed-text">
                            <p><?php echo $post_fetch['post_text'];?></p>
                        </div>

                    </a>

                        <?php 
                        // Start: Post Img or Vid
                        if($post_fetch['post_img'] != ''){
                            ?>
                            <div class="feed-img">
                                <a href="posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $_SESSION['unique_id'] ?>">
                                    <img src="../create_post/images/<?php echo $post_fetch['post_img'] ?>" alt="">
                                </a>
                            </div>
                        <?php
                        
                        }elseif($post_fetch['post_vid'] != ''){
                            ?>
                            <div class="feed-img">
                                <div style="position: relative; display: inline-block" class="overlayVid">
                                    
                                    <video controls class="uploadVid" width="100%" height="100%">
                                        <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/mp4">
                                        <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/ogg">
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
                            <a href="posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=true&ci=<?php echo $comment_id ?>&visit=<?php echo $session_id ?>"><span class="material-icons-sharp">maps_ugc</span></a>
                                <p>

                                    <?php 
                                        // Fetch numbers of comment
                                        $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$post_fetch['post_id']}' AND comment != ''");
                                        
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
                        <a href="#"><span class="material-icons-sharp save-icon">turned_in</span></a>
                    </div>
                    <!--<div class="liked-by">-->
                    <!--    <img src="../images/profile-4.jpg" alt="">-->
                    <!--    <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p>-->
                    <!--</div>-->
                    <a href="posts/?mbpc=<?php echo $fetch_post['post_id']; ?>" style="color: #677db6;">
                        <?php
                            if($comment_row > 0){
                                echo '<small>View all comments</small>';
                            }
                        ?>
                            </a>
                </div>

        <?php

            }
        ?>

        </div>
    </div>
</div>





<!--------------------========User Profile Edit for Desktop----------------==========-->
<div class="user-profile-edit-pop-up-bg">

    <div class="user-profile-edit-pop-up">
        <div class="user-profile-edit-pop-up-head">
            <div>
                <span class="material-icons-sharp" onclick="closeEditPopUp()">close</span>
            </div>
            <div class="user-profile-edit-pop-up-head-texts-h1">
                <h1>Edit Your Profile</h1>
            </div>
        </div>
        <!-- Background Photo -->
        <div class="user-profile-edit-pop-up-head-btn">
            <p>Background Photo</p>
            <button type="button" class="edit-btn">Edit<span class="material-icons-sharp">edit</span></button>
        </div>
        <div class="user-profile-edit-pop-up-bg-photo">
            <img src="../images/cover.jpg" alt="">
        </div>

        <!-- Profile Photo -->
        <div class="user-profile-edit-pop-up-head-btn">
            <p>Profile Photo</p>
            <button type="button" class="edit-btn">Edit<span class="material-icons-sharp">edit</span></button>
        </div>
        <center>
            <div class="user-profile-edit-pop-up-bg-profile-photo">
                <img src="../images/avater.jpg" alt="">
            </div>
        </center>

        <!-- Bio -->
        <div class="user-profile-edit-pop-up-head-btn">
            <p>Bio</p>
            <button type="button" class="edit-btn">Edit<span class="material-icons-sharp">edit</span></button>
        </div>
        <div class="user-bio">
            <p>Music star @ FM Music and Brands, Orange 94.5 and UK Movie star | A Christain | A Single Mother </p>
         </div>

        <!-- Marital Status -->
        <div class="user-profile-edit-pop-up-head-btn">
            <p>Status</p>
            <button type="button" class="edit-btn">Edit<span class="material-icons-sharp">edit</span></button>
        </div>
        <div class="user-bio-status">
            <p>Single</p>
         </div>

        <!-- Profession -->
        <div class="user-profile-edit-pop-up-head-btn">
            <p>Profession</p>
            <button type="button" class="edit-btn">Edit<span class="material-icons-sharp">edit</span></button>
        </div>
        <div class="user-bio-status">
            <p>--Music Artist</p>
         </div>





    </div>

</div>


<!-------------Include Mobile Nav Menu------------->
<?php include "../includes/nav_menu_mobile.php"?>

<!-- Include Mobile Menu -->
<?php include "../includes/mobile_menu.php"?>

<!-- Include Mobile Menu -->
<?php include "../includes/desktop_notification_pop.php"?>



<!-- Pop Up for Images -->

<div class="image_view_pop_up">

    <div class="hide">
        <span class="material-icons-sharp">close</span>
    </div>

    <?php if($user_data['profile_pic'] != ""){
    ?>      
        <img src="profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
    <?php
    }else{
        ?>
            <img src="../images/avater.jpg" alt="">
    <?php
    }
    ?>
</div>



<div class="image_view_pop_up_cover">
    <div class="hide">
        <span class="material-icons-sharp">close</span>
    </div>

    <?php if($user_data['cover_photo'] != ""){
        ?>
            <img src="cover_photos/<?php echo $user_data['cover_photo'] ?>" alt="">
    <?php
    }else{
        ?>
            <img src="../images/cover.jpg" alt="">
    <?php
    }
    ?>
</div>

<script src="../newjs/picview.js"></script>
<script src="../newjs/count_followers.js"></script>
<script src="../newjs/cancle_request.js"></script>
<script src="../newjs/unfollow_user.js"></script>
<script src="../newjs/follow_user.js"></script>
<script src="../newjs/follow.js"></script>
<script src="../javascript/openProfileAction.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/reactions.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>