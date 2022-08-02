<?php
    // Start Session
    session_start();

    // Includes 
    require("authentications/config_tdb.php");
    require("create_post/timefunction.php");
    require("create_post/process_post_desktop.php");
    
    
    $session = $_SESSION['unique_id'];
    $user_data = "";
    $fullname = "";

    if($session){
        // Fetch User Data
        $unique_id = $_SESSION['unique_id'];
        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `unique_id` = '$unique_id'");

        if(mysqli_num_rows($sql) == 1){
            $user_data = mysqli_fetch_assoc($sql);

            $f_name = $user_data['f_name'];
            $l_name = $user_data['l_name'];

            $fullname = "{$user_data['f_name']} {$user_data['l_name']}";
        }

    }else{
        header("location: authentications");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAE | CHAT</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- StyleSheet -->
    <link rel="stylesheet" href="beauties/styles.css">

    <!-- For Dark Mode -->
    <link rel="stylesheet" href="beauties/darkmode.css">

    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

    <!-- jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--- Carosel Slide -->
    <link rel="stylesheet" href="beauties/carosel.css">

    <!--- Bookmark --->
    <script src="newjs/bookmark.js"></script>


</head>

<body id="body">   

<!---------------------------Nav For Desktop--------------------------->
<nav class="desktop">
    <div class="container">
        <div class="nav-left">
            <div class="rounded-photo logo">
                <a href="../"><img src="images/newBaeLogo.png" alt=""></a>
            </div>
            <div class="search-input">
                <span class="material-icons-sharp">search</span>
                <input type="search" placeholder="Search a friend">
            </div>
        </div>
        <div class="nav-center">
            <ul>
                <li><a href="index.php">
                    <span class="material-icons-sharp">home</span>
                </a></li>
                <li><a href="friends">
                    <span class="material-icons-sharp">people_outline</span>
                </a></li>
                <li><a href="#">
                    <span class="material-icons-sharp">textsms</span>
                </a></li>
                <!-- <li><a href="#">
                    <span class="material-icons-sharp">storefront</span>
                </a></li> -->
            </ul>
        </div>
        <div class="nav-right">
            <a href="profile/?bup=<?php echo $session;?>"><div class="nav-user-profile">
                <div class="rounded-photo online">
                    <?php if($user_data['profile_pic'] != ""){
                        ?>      
                            <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                        <?php
                        }else{
                            ?>
                            <img src="images/avater.jpg" alt="">
                        <?php
                        }
                    ?>
                </div>
                <div class="profile-name">
                    <h1><?php echo $user_data['f_name'];?></h1>
                </div>
            </div></a>
            <ul>
                <li>
                    <button onclick="openNotification()" style="background: transparent"><span id="notification_open" class="material-icons-sharp">notifications</span></button>
                </li>
                <li class="drop-arrow" onclick="settings_menu_toggle()">
                    <span class="material-icons-sharp">arrow_drop_down</span>
                </li>
            </ul>
        </div>

        <!-------------------------Setting Menu------------------------->
        <div class="settings-menu">
            <div class="settings-menu-inner">
            <a href="profile/?bup=<?php echo $session ?>">
                <div class="aside-user-profile">
                    <div class="rounded-photo online">
                        <?php if($user_data['profile_pic'] != ""){
                            ?>      
                                <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                <img src="images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div>
                    <div class="profile-name">
                        <h2><?php echo $fullname?></h2>
                        <a href="#"><small>See your profile </small></a>
                    </div>
                </div>
            </a>
                <hr>
                <a href="#"><div class="aside-user-profile">
                    <div class="icons-menu">
                        <span class="material-icons-sharp">announcement</span>
                    </div>
                    <div class="profile-name">
                        <h2>Give Feedback</h2>
                        <a href="#"><small>Help us to improve on our design</small></a>
                    </div>
                </div></a>
                <hr>
                <a href="#"><div class="setting-links">
                    <span class="material-icons-sharp">settings</span>
                    <div class="links-text">
                        <div>
                            <h2>Settings & Privacy</h2>
                        </div>
                        <div>
                            <span class="material-icons-sharp">chevron_right</span>
                        </div>
                    </div>
                </div></a>
                <a href="#"><div class="setting-links">
                    <span class="material-icons-sharp">help</span>
                    <div class="links-text">
                        <h2>Help & Support</h2>
                        <span class="material-icons-sharp">chevron_right</span>
                    </div>
                </div></a>
                <a href="#"><div class="setting-links">
                    <span class="material-icons-sharp">dark_mode</span>
                    <div class="links-text">
                        <h2>Dark/Light</h2>
                        <div id="dark-btn">
                            <span></span>
                        </div>
                    </div>
                </div></a>
                <a href="authentications/logout.php"><div class="setting-links">
                    <span class="material-icons-sharp">logout</span>
                    <div class="links-text">
                        <h2>Logout</h2>
                        <span class="material-icons-sharp">chevron_right</span>
                    </div>
                </div></a>
            </div>
        </div>
    </div>
</nav>


<!-----------------------------Nav For Mobile----------------------------->
<div class="mobile-container">
    <div class="mobile">
            <div><a href="/">
                <span class="material-icons-sharp">home</span>
            </a></div>
            <div><a href="friends/">
                <span class="material-icons-sharp">people_outline</span>
            </a></div>
            <div><a href="create_post/">
                <span class="material-icons-sharp" onclick="openBtn()">add_circle</span>
            </a></div>
            <div class="red_dot_notification"><a href="notifications/?red=1">
                <?php

                    // Fetch Notification Row For the Red Dot Notification
                    $redQuery = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '$session' AND red_dot_not = 0");
                    $dotRow = mysqli_num_rows($redQuery);
                    
                    if($dotRow > 0){
                        // Fetch the unread notification Row Count
                        $unread_sql = mysqli_query($con, "SELECT * FROM notifications WHERE status = 0 and receiver_id = '$session'");
                        $unread_row = mysqli_num_rows($unread_sql);
                        ?>
                        <div class="red_dot_not"><span class="material-icons-sharp">circle</span><?php
                         if($unread_row > 0){
                            echo $unread_row;
                         } 
                         ?></div>
                    <?php    
                    }
                ?>
                <span class="material-icons-sharp">notifications</span>
            </a></div>
            <div>
                <span class="material-icons-sharp mobile-menu-open">menu</span>
            </div>                    
        </ul>
    </div>
</div>

    <!------------------------------For Mobile Page Header------------------------------>

    <div class="mobile-page-header">
        <div class="mobile-page-header-img">
        <a href="profile/?bup=<?php echo $session?>&upd=0">
    
            <?php if($user_data['profile_pic'] != ""){
                ?>      
                    <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                <?php
                }else{
                    ?>
                    <img src="images/avater.jpg" alt="">
                <?php
                }
            ?>

        </a>
        </div>

        <div class="mobile-page-header-search">
            <span class="material-icons-sharp">search</span>
            <input type="search" placeholder="Looking for a friend?">
        </div>
    
        <a href="messenger"><span class="material-icons-sharp">question_answer</span></a>
    </div>


<!-----------------------------Mobile Menu----------------------------->
    <div class="mobile-menu">
        <a href="profile/?bup=<?php echo $session?>&upd=0" class="mobile-menu-profile"> 
            <div class="mobile-menu-profile-photo">
                <?php if($user_data['profile_pic'] != ""){
                    ?>      
                        <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                    <?php
                    }else{
                        ?>
                        <img src="images/avater.jpg" alt="">
                    <?php
                    }
                ?>
            </div>
            <div class="mobile-menu-profile-name">
                <p><?php echo $fullname?></p>
            </div>
        </a>

        <div><a href="friends">
            <span class="material-icons-sharp">people</span>
            <p>Friends</p>
        </a></div>

        <div><a href="communities">
            <span class="material-icons-sharp">groups</span>
            <p>Groups</p>
        </a></div>

        <div><a href="marketplace">
            <span class="material-icons-sharp">storefront</span>
            <p>Marketplace</p>
        </a></div>

        <div><a href="bookmarks">
            <span class="material-icons-sharp">bookmark</span>
            <p>Bookmark</p>
        </a></div>

        <div><a href="messenger">
            <span class="material-icons-sharp">chat</span>
            <p>Messenger</p>
        </a></div>

        <div><a href="notifications">
            <span class="material-icons-sharp">notifications</span>
            <p>Notification</p>
        </a></div>

        <div><a href="settings">
            <span class="material-icons-sharp">settings</span>
            <p>Settings & Privacy</p>
        </a></div>

        <div class="links-text">
            <div class="flex-links">
                <span class="material-icons-sharp dark-mode-span-for-mobile">dark_mode</span>
                <h2>Dark/Light</h2>
            </div>
            <div id="dark-btn2">
                <span></span>
            </div>
        </div>
        <div><a href="helpandsupport">
            <span class="material-icons-sharp">help</span>
            <p><span style="color:rgb(255, 118, 94); font-size: 1rem">BaE</span> Help & Support</p>
        </a></div>
        <div><a href="authentications/logout.php">
            <span class="material-icons-sharp">logout</span>
            <p>Logout</p>
        </a></div>
        <div class="mobile-menu-close-btn">
            <span class="material-icons-sharp mobile-menu-close-btn">filter_list</span>
        </div>
    </div>

    </div>

<!------------------------End of Mobile Navigation------------------------>

    <!-- Page Contents -->
    <main>
        <aside>
            <ul>
                <li><a href="profile/?bup=<?php echo $session?>&upd=0">
                    <div class="aside-user-profile">
                        <div class="rounded-photo online">
                            <?php if($user_data['profile_pic'] != ""){
                                ?>      
                                    <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                                <?php
                                }else{
                                    ?>
                                    <img src="images/avater.jpg" alt="">
                                <?php
                                }
                            ?>
                        </div>
                        <div class="profile-name">
                            <h2><?php echo $fullname?></h2>
                        </div>
                    </div>
                </a></li>
                <li><a href="friends">
                    <span class="material-icons-sharp aside-span">people</span>
                    <h2>Friends</h2>
                </a></li>
                <li><a href="#">
                    <span class="material-icons-sharp aside-span">groups</span>
                    <h2>Groups</h2>
                </a></li>
                <li><a href="#">
                    <span class="material-icons-sharp aside-span">storefront</span>
                    <h2>Marketplace</h2>
                </a></li>
                <li><a href="messenger/">
                    <span class="material-icons-sharp aside-span">message</span>
                    <h2>Messenger</h2>
                </a></li>
                <li><a href="bookmarks/">
                    <span class="material-icons-sharp aside-span">bookmark</span>
                    <h2>Bookmark</h2>
                </a></li>
            <hr>
                <li><a href="#">
                    <span class="material-icons-sharp aside-span">notifications</span>
                    <h2>Notification</h2>
                </a></li>
                <li><a href="#">
                    <span class="material-icons-sharp aside-span">settings</span>
                    <h2>Settings</h2>
                </a></li>
                <li>
                    <a href="authentications/logout.php">
                        <div class="a">
                            <span class="material-icons-sharp aside-span">logout</span>
                            <h2>Logout</h2>
                        </div>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- ====================================MIDDLE==================================== -->
        <div class="middle">
            <div class="post">
                <div class="create-post">
                    <a href="profile/?bup=<?php echo $session?>"><div class="rounded-photo online">
                        <?php if($user_data['profile_pic'] != ""){
                            ?>      
                                <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                <img src="images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div></a>
                    <div class="input-btn">
                        <input type="text" placeholder="What's on your mind?" onclick="popup()">
                        <button type="button" class="btn">Post</button>
                    </div>
                </div>
                <!-- <hr>
                <div class="actions-create-post">
                    <a href="#">
                        <div class="actions">
                            <span class="material-icons-sharp">smart_display</span>
                            <h1>Videos</h1>
                        </div>
                    </a>
                    <a href="#">
                        <div class="actions">
                            <span class="material-icons-sharp">collections</span>
                            <h1>Image</h1>
                        </div>
                    </a>
                    <a href="#">
                    <div class="actions">
                        <span class="material-icons-sharp">sell</span>
                        <h1>Sell</h1>
                    </div>
                    </a>
                </div> -->

            </div>

            <div id="more-post-desktop">

                <div id="hideRepost" class="user-profile-action-icons">
                    <span class="material-icons-sharp">autorenew</span>
                    <p id="p_repost_desktop">Repost</p>
                </div>

                <div class="user-profile-action-icons" id="hideSave">
                    <span class="material-icons-sharp">bookmark</span>
                    <p>Save Post</p>
                </div>
                
                <div id="hideView_desktop2" class="user-profile-action-icons">
                    <span class="material-icons-sharp">delete</span>
                    <a href="" id="delete_desktop"><p>Delete Post</p></a>
                </div>
                
                <div id="hideEdit_desktop2" class="user-profile-action-icons">
                    <span id="hideSpan" class="material-icons-sharp">edit</span>
                    <p id="post_edit_button_desktop">Edit Post</p>
                </div>

                <div class="user-profile-action-icons">
                    <span class="material-icons-sharp">account_circle</span>
                    <p id="user_info"></p>
                </div>


            </div>

            <? // Carosel Post ?>
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <div class="numbertext">1 / 4</div>
                    <img src="images/slide1.jpg">
                    <div style="background: black; color: white; opacity: 0.8" class="text">Bringing friends together</div>
                </div>
            
                <div class="mySlides fade">
                    <div class="numbertext">2 / 4</div>
                    <img src="images/slide2.jpg">
                    <div style="background: black; color: white; opacity: 0.8" class="text">More beneficial updates soon</div>
                </div>
            
                <div class="mySlides fade">
                    <div class="numbertext">3 / 4</div>
                    <img src="images/slide3.jpg">
                    <div style="background: black; color: white; opacity: 0.8" class="text">Near by friends easy to get</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">4 / 4</div>
                    <img src="images/slide4.jpg">
                    <div style="background: black; color: white; opacity: 0.8" class="text">Don't miss out, join the train</div>
                </div>
            
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            
            <?php // Post Based on Logged in User New Post Not less than 60s ?>
            <?php
                $session_id = $session;

                // Fetch Post if Post unique_id == SESSION ID
                $sql_post = mysqli_query($con, "SELECT * FROM posts WHERE unique_id = '$session_id' ORDER BY id DESC LIMIT 1");

                while($post_fetch = mysqli_fetch_assoc($sql_post)){
                $post_unique_id = $post_fetch['unique_id'];
                $post_it_id = $post_fetch['post_id'];
                $session_id = $_SESSION['unique_id'];

                // Send Post ID to Ajax

                $post_post_time = strtotime($post_fetch['timeposted']);
                $current_time = strtotime(date("Y-m-d h:i:sa"));
                $time_difference = $current_time - $post_post_time;

                // Fetch the user info from the users table
                $fetch_user_info = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$post_unique_id'");

                $fetch_details = mysqli_fetch_assoc($fetch_user_info);

                $user_fullname = $fetch_details['f_name'] . ' ' . $fetch_details['l_name']; 
                $user_profile_pic = $fetch_details['profile_pic'];
                
                $seconds = $time_difference;
                if($seconds < 60){
                    // echo $seconds;
                    ?>
                        <form action="" class="post_id_form">
                            <input type="text" name="id" value="<?php echo $post_it_id ?>" id="" hidden>
                        </form>

                        <div class="feed">
                            <div class="feed-head">

                                <?php // Start: Post Owner Profile ?>
                                <a href="profile/?bup=<?php echo $post_unique_id; ?>&upd=0">
                                    <div class="feed-user">
                                        <div class="rounded-photo">
                                            <?php 
                                                if($fetch_details['profile_pic'] != ""){
                                                ?>      
                                                    <img src="profile/profile_photos/<?php echo $fetch_details['profile_pic'] ?>" alt="">
                                                <?php
                                                }else{
                                                    ?>
                                                        <img src="images/avater.jpg" alt="">
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
                                            <!-- <p id="notice_post" style="font-size: 0.8rem; color: grey">new post disappers in 60s</p> -->
                                            
                                        </div>
                                    </div>
                                </a>
                                <?php // End: Post Owner Profile ?>

                                <div class="postMoreOptionDesktop"><span class="material-icons-sharp">more_horiz</span></div>

                                <?php 
                                    // More Button for Mobile
                                    if($post_fetch['repost'] == ""){
                                        
                                        ?>
                                        <div onclick="post_Id('<?php echo $post_it_id?>', '<?php echo $post_unique_id ?>', '<?php echo $session_id ?>', '<?php echo $post_fetch['post_text'] ?>')" class="postMoreOption"><span class="material-icons-sharp">more_horiz</span></div>
                                    <?php
                                    }
                                ?>
                            </div>
                            
                            <?php // Start: Post Comments  ?>
                            <a href="posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=none&visit=<?php echo $session_id ?>">

                                <?php // Start: Post Text ?>

                                <div class="feed-text">
                                    <p><?php echo $post_fetch['post_text'];?></p>
                                </div>

                                <?php
                                
                                    // Start: Post Img or Vid
                                    if($post_fetch['post_img'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <a href="posts/?mbpc=<?php echo $post_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session ?>">
                                                <img src="create_post/images/<?php echo $post_fetch['post_img'] ?>" alt="">
                                            </a>
                                        </div>
                                    <?php
                                    
                                    }elseif($post_fetch['post_vid'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <div style="position: relative; display: inline-block" class="overlayVid">
                                                <img style="position: absolute; z-index: 2; margin: 0 auto; left: 0; right: 0; top: 40%; text-align: center; width: 60%; color: white; 
                                                font-weight: 600; text-transform: capitalize; font-size: 2rem; cursor: pointer; width: 70px;" 
                                                class="playImage" onclick="playBtn()" src="images/play.png" alt="">
                                                <video onclick="pauseBtn()" class="uploadVid" width="100%" height="100%">
                                                    <source src="create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/mp4">
                                                    <source src="create_post/videos/<?php echo $post_fetch['post_vid'] ?>">
                                                    Your Browser Does Not Support the Video Tag
                                                </video>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                ?>
                            
                            </a>

                            <?php // Start: Post Reactions ?>
                            <div class="feed-actions">
                                <div class="feed-action">
                                    <div class="feed-span">
                                        <span style="color: #677db6" class="material-icons-sharp like_icon">favorite_border</span>
                                        <p id="like_count"></p>

                                        <form action="" id="likeForm">
                                            <input type="text" name="unique_id" class="session_id" value="<?php echo $session ?>" hidden>
                                            <input type="text" name="post_id" id="post_id" value="<?php echo $post_id?>" hidden>
                                        </form>
                                    </div>

                                    <div class="feed-span">
                                    <!-- Button for Post reactions pop up -->
                                    <a href="posts/?mbpc=<?php echo $post_fetch['post_id'];?>&stat=none&visit=<?php echo $session_id ?>"><span class="material-icons-sharp">maps_ugc</span></a>
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
                            <div class="liked-by">
                                <!-- <img src="images/profile-4.jpg" alt=""> -->
                                <!-- <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p> -->
                            </div>
                        </div>

                <?php

                }

                }
            ?>
        

            <?php // Post Based on Edit ?>
            <?php
                $session = $_SESSION['unique_id'];
                $edit_query = mysqli_query($con, "SELECT * FROM posts WHERE edited = '1'");

                $es = mysqli_num_rows($edit_query);
                
                while ($edit_fetch = mysqli_fetch_assoc($edit_query)) {
                    
                    $edit_unique_id = $edit_fetch['unique_id'];
                    $edit_post_id = $edit_fetch['post_id'];
                    
                    // Fetch user details
                    $edit_query2 = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$edit_unique_id'");
                    $edit_fetch2 = mysqli_fetch_assoc($edit_query2);

                    $edit_post_text = $edit_fetch['post_text'];
                    $edit_post_img = $edit_fetch['post_img'];
                    $edit_fullname = $edit_fetch2['f_name'] . " " . $edit_fetch2['l_name'];
                    $edit_profile_pic = $edit_fetch2['profile_pic'];

                    // Post should appear if it's not less than 30secs
                    $timeposted = $edit_fetch['timeposted2'];
                    $edit_time_posted = strtotime($timeposted);
                    $edit_current_time = strtotime(date("Y-m-d h:i:sa"));

                    $difference = $edit_current_time - $edit_time_posted;

                    if($difference < 30){

                        ?>

                        <div class="feed">
                            <div class="feed-head">

                                <?php // Start: Post Owner Profile ?>
                                <a href="profile/?bup=<?php echo $edit_unique_id; ?>&upd=0">
                                    <div class="feed-user">
                                        <div class="rounded-photo">
                                            <?php 
                                                if($edit_fetch2['profile_pic'] != ""){
                                                ?>      
                                                    <img src="profile/profile_photos/<?php echo $edit_fetch2['profile_pic'] ?>" alt="">
                                                <?php
                                                }else{
                                                    ?>
                                                        <img src="images/avater.jpg" alt="">
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="feed-user-name">
                                            <p><?php echo $edit_fullname?></p>

                                            <?php
                                                $period = $edit_fetch['timeposted'];
                                            ?>

                                            <small><?php echo time_posted($period)?></small>
                                            <!-- <p id="notice_post" style="font-size: 0.8rem; color: grey">new post disappers in 60s</p> -->
                                            
                                        </div>
                                    </div>
                                </a>
                                <?php // End: Post Owner Profile ?>

                                <div class="postMoreOptionDesktop"><span class="material-icons-sharp">more_horiz</span></div>

                                    <div onclick="post_Id('<?php echo $edit_post_id?>', '<?php echo $edit_unique_id ?>', '<?php echo $session ?>', '<?php echo $edit_fetch['post_text'] ?>')" class="postMoreOption"><span class="material-icons-sharp">more_horiz</span></div>
                            </div>
                            
                            <?php // Start: Post Comments  ?>
                            <a href="posts/?mbpc=<?php echo $edit_fetch['post_id']; ?>&stat=none&visit=<?php echo $session ?>">

                                <?php // Start: Post Text ?>

                                <div class="feed-text">
                                    <p><?php echo $edit_fetch['post_text'];?></p>
                                </div>

                                <?php
                                
                                    // Start: Post Img or Vid
                                    if($edit_fetch['post_img'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <a href="posts/?mbpc=<?php echo $edit_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session ?>">
                                                <img src="create_post/images/<?php echo $edit_fetch['post_img'] ?>" alt="">
                                            </a>
                                        </div>
                                    <?php
                                    
                                    }elseif($edit_fetch['post_vid'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <div style="position: relative; display: inline-block" class="overlayVid">
                                                <img style="position: absolute; z-index: 2; margin: 0 auto; left: 0; right: 0; top: 40%; text-align: center; width: 60%; color: white; 
                                                font-weight: 600; text-transform: capitalize; font-size: 2rem; cursor: pointer; width: 70px;" 
                                                class="playImage" onclick="playBtn()" src="images/play.png" alt="">
                                                <video onclick="pauseBtn()" class="uploadVid" width="100%" height="100%">
                                                    <source src="create_post/videos/<?php echo $edit_fetch['post_vid'] ?>" type="video/mp4">
                                                    <source src="create_post/videos/<?php echo $edit_fetch['post_vid'] ?>">
                                                    Your Browser Does Not Support the Video Tag
                                                </video>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                ?>
                            
                            </a>

                            <?php // Start: Post Reactions ?>
                            <div class="feed-actions">
                                <div class="feed-action">
                                    <div class="feed-span">
                                        <span style="color: #677db6" class="material-icons-sharp like_icon">favorite_border</span>
                                        <p id="like_count"></p>

                                        <form action="" id="likeForm">
                                            <input type="text" name="unique_id" class="session_id" value="<?php echo $session ?>" hidden>
                                            <input type="text" name="post_id" id="post_id" value="<?php echo $edit_post_id?>" hidden>
                                        </form>
                                    </div>

                                    <div class="feed-span">
                                    <!-- Button for Post reactions pop up -->
                                    <a href="posts/?mbpc=<?php echo $edit_fetch['post_id'];?>&stat=none&visit=<?php echo $session ?>"><span class="material-icons-sharp">maps_ugc</span></a>
                                        <p>

                                            <?php 
                                                // Fetch numbers of comment
                                                $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$edit_fetch['post_id']}' AND comment != ''");
                                                
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
                                <!-- <img src="images/profile-4.jpg" alt=""> -->
                                <!-- <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p> -->
                            </div>
                        </div>

                    <?php
                    }

                }
            ?>


            <?php // Feed Based on General ?>
            <div class="feeds">
                <!------------------------------------FEEDS------------------------------------>
                <?php
                // Fetch Posts from the Post Table
                $fetch_post_query = mysqli_query($con, "SELECT * FROM posts ORDER BY RAND()");
                $fetch_re_query = mysqli_query($con, "SELECT * FROM posts WHERE repost = '1' ORDER BY RAND ()");

                while($fetch_post = mysqli_fetch_assoc($fetch_post_query) ){

                    // REPOST DETAILS
                    $re_fetch = mysqli_fetch_assoc($fetch_re_query);
                    $row_re = mysqli_num_rows($fetch_re_query);
                    $repost = $re_fetch['repost'];



                    $user_id = $fetch_post['unique_id'];
                    $post_id = $fetch_post['post_id'];

                    

                    // Fetch the user info from the users table
                    $fetch_user_info = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$user_id'");

                    $fetch_details = mysqli_fetch_assoc($fetch_user_info);

                    $user_fullname = $fetch_details['f_name'] . ' ' . $fetch_details['l_name']; 
                    $user_profile_pic = $fetch_details['profile_pic'];

                    if($fetch_post['repost'] != "1"){

                    ?>
                        <div class="feed">
                            <?php // Feed Head for main Post ?>
                            <?php
                                ?>
                                <div class="feed-head">
                                    <?php // Start: Post Owner Profile ?>
                                    <a href="profile/?bup=<?php echo $user_id; ?>&upd=0">
                                        <div class="feed-user">
                                            <div class="rounded-photo">
                                                <?php 
                                                    if($fetch_details['profile_pic'] != ""){
                                                    ?>      
                                                        <img src="profile/profile_photos/<?php echo $fetch_details['profile_pic'] ?>" alt="">
                                                    <?php
                                                    }else{
                                                        ?>
                                                            <img src="images/avater.jpg" alt="">
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="feed-user-name">
                                                <p><?php echo $user_fullname?></p>

                                                <?php
                                                    $period = $fetch_post['timeposted'];
                                                ?>

                                                <small><?php echo time_posted($period)?> | <?php echo $fetch_details['location']?></small>
                                            </div>
                                        </div>
                                    </a>

                                    <?php // End: Post Owner Profile ?>
                                    
                                    <input type="text" class="sessionId" value="<?php echo $session?>" hidden>
                                    
                                    <div onclick="post_more_desktop('<?php echo $user_fullname?>', '<?php echo $post_id?>', '<?php echo $user_id ?>', '<?php echo $session_id ?>', '<?php echo $fetch_post['post_text'] ?>')"
                                     class="postMoreOptionDesktop"><span class="material-icons-sharp">more_horiz</span></div>

                                    <div onclick="post_Id('<?php echo $user_fullname?>', '<?php echo $post_id?>', '<?php echo $user_id ?>', '<?php echo $session_id ?>', '<?php echo $fetch_post['post_text'] ?>')" class="postMoreOption"><span class="material-icons-sharp">more_horiz</span></div>
                                
                                </div>

                            
                                <?php // Start: Post Comments  ?>
                            
                                <a href="posts/?mbpc=<?php echo $fetch_post['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session ?>">

                                <?php // Start: Post Text ?>

                                <div class="feed-text">
                                    <p><?php echo nl2br($fetch_post['post_text'], false);?></p>
                                </div>
                                </a>
                        
                                <?php
                                
                                    // Start: Post Img or Vid
                                    if($fetch_post['post_img'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <a href="posts/?mbpc=<?php echo $fetch_post['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session ?>">
                                                <img src="create_post/images/<?php echo $fetch_post['post_img'] ?>" alt="">
                                            </a>
                                        </div>
                                    <?php
                                    
                                    }elseif($fetch_post['post_vid'] != ''){
                                        ?>
                                        <div class="feed-img">
                                            <div style="position: relative; display: inline-block" class="overlayVid">
                                                
                                                <video controls class="uploadVid" width="100%" height="100%">
                                                    <source src="create_post/videos/<?php echo $fetch_post['post_vid'] ?>" type="video/mp4">
                                                    <source src="create_post/videos/<?php echo $fetch_post['post_vid'] ?>" type="video/ogg">
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
                                        <form action="" id="love_react_form">
                                            <input type="text" name="unique_id" class="session_id" value="<?php echo $session ?>" hidden>
                                            <input type="text" name="post_id" id="posst_id" value="<?php echo $post_id?>" hidden>
                                        </form>

                                        <!-- <script>
                                            let post_id = <?php// echo $post_id ?>'

                                            I was working on Bookmark
                                        </script> -->
                                        
                                        <button onclick="postDrop(<?php echo $post_id ?>)" style="background: transparent; cursor: pointer; color: #677db6"><span class="material-icons-sharp">favorite_border</span></button>
                                    
                                        <p id="like_count_general" class="count_likes">
                                            
                                            <?php
                                                
                                                // Fetch Like Count
                                                $sql_likes = mysqli_query($con, "SELECT * FROM love_reaction_table WHERE post_id = '$post_id'");
                                                $row_likes = mysqli_num_rows($sql_likes);
                                                echo $row_likes;
                                                
                                            ?>
                                        </p>
                                        
                                    </div>

                                    <div class="feed-span">
                                    <!-- Button for Post reactions pop up -->
                                    <a href="posts/?mbpc=<?php echo $fetch_post['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session ?>"><span style="cursor: pointer" class="material-icons-sharp">maps_ugc</span></a>
                                        <p>

                                            <?php 
                                                // Fetch numbers of comment
                                                $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$fetch_post['post_id']}' AND comment != ''");
                                                
                                                $comment_row = mysqli_num_rows($sql_reactions);

                                                echo $comment_row;

                                            
                                            ?>
                                        </p>
                                    </div>

                                    <div class="feed-span">
                                        <a href="posts/repost.php?post_id=<?php echo $post_id ?>&user_id=<?php echo $user_id ?>"><span class="material-icons-sharp">autorenew</span></a>
                                        <p>6</p>
                                    </div>
                                </div>
                                
                                <input type="text" class="post_id_bookmark" value="<?php echo $post_id ?>" name="" id="" hidden>
                                <span class="material-icons-sharp saveIcon" onclick="post_id(<?php echo $post_id ?>)">turned_in</span>
                            </div>

                            
                            <div class="liked-by">
                                <!-- <img src="images/profile-4.jpg" alt=""> -->
                                <!-- <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p> -->
                            </div>


                            <a href="posts/?mbpc=<?php echo $fetch_post['post_id']; ?>" style="color: #677db6;">
                                <?php
                                    if($comment_row > 0){
                                        echo '<small>View all comments</small>';
                                    }
                                ?>
                            </a>
                            
                        </div>

                        <div class="cls">
                        </div>
                    <?php
                    }
                    ?>
                    <?php

            ?>

                <?php

                    if($row_re > 0 && $repost != ""){

                        // Fetch While
                            
                            // Post Table Details
                            $repost_reposter_ID = $re_fetch['unique_id'];
                            $repost_owner_ID = $re_fetch['owner_id'];
                            $repost_post_id = $re_fetch['post_id'];
                            $repost_post_text = $re_fetch['post_text'];
                            $repost_re_post_ID = $re_fetch['re_post_id'];
                            $repost_post_img = $re_fetch['post_img'];
                            $repost_post_vid = $re_fetch['post_vid'];


                            // ================== Fetch the Owner User INFO
                            $repost_user_query = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$repost_owner_ID'");
                            $repost_user_fetch = mysqli_fetch_assoc($repost_user_query);

                            // Owner Details
                            $repost_owner_fullname = $repost_user_fetch['f_name'] . " " . $repost_user_fetch['l_name'];
                            $repost_owner_timeposted = $re_fetch['timeposted'];
                            $repost_owner_profile_pic = $repost_user_fetch['profile_pic'];

                            // ================== Fetch the Reposter User INFO
                            $repost_reposter_query = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$repost_reposter_ID'");
                            $repost_reposter_fetch = mysqli_fetch_assoc($repost_reposter_query);

                            // Reposter Details
                            $repost_reposter_fullname = $repost_reposter_fetch['f_name'] . " " . $repost_reposter_fetch['l_name'];
                            $repost_reposter_timeposted = $re_fetch['timeposted2'];
                            $repost_reposter_profile_pic = $repost_reposter_fetch['profile_pic'];

                            $session_id = $_SESSION['unique_id'];

                        ?>
                        <div class="feedRepost">
                            <div style="margin-bottom: 2rem" class="feed-head">
                                <?php // Start: Post Owner Profile ?>
                                <a href="profile/?bup=<?php echo $repost_reposter_ID ?>&upd=0">
                                    <div class="feed-user">
                                        <div class="rounded-photo">
                                            <?php 
                                                if($repost_reposter_profile_pic != ""){
                                                ?>      
                                                    <img src="profile/profile_photos/<?php echo $repost_reposter_profile_pic ?>" alt="">
                                                <?php
                                                }else{
                                                    ?>
                                                        <img src="images/avater.jpg" alt="">
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="feed-user-name">
                                            <p><?php echo $repost_reposter_fullname?></p>

                                            <?php
                                                $period = $re_fetch['timeposted2'];
                                            ?>

                                            <small><?php echo time_posted($period)?> | shared post</small>
                                        </div>
                                    </div>
                                </a>

                                <?php // End: Post Owner Profile ?>
                                
                                <input type="text" class="sessionId" value="<?php echo $session?>" hidden>
                                <div onclick="post_more_desktop_repost('<?php echo $repost_reposter_fullname?>', '<?php echo $repost_post_id?>', '<?php echo $repost_reposter_ID ?>', '<?php echo $session_id ?>', '<?php echo $repost_post_text ?>', '<?php echo $repost_re_post_ID ?>')"
                                class="postMoreOptionDesktop"><span class="material-icons-sharp">more_horiz</span></div>

                                <div onclick="post_Id_mobile_repost('<?php echo $repost_reposter_fullname ?>', '<?php echo $repost_post_id?>', '<?php echo $repost_reposter_ID ?>', '<?php echo $session_id ?>', '<?php echo $repost_post_text ?>', '<?php echo $repost_re_post_ID ?>')" 
                                class="postMoreOption"><span class="material-icons-sharp">more_horiz</span></div>
                            
                            </div>
                            
                            
                            <div class="feed-head">
                                <?php // Start: Post Owner Profile ?>
                                <a href="profile/?bup=<?php echo $repost_owner_ID; ?>&upd=0">
                                    <div class="feed-user">
                                        <div class="rounded-photo">
                                            <?php 
                                                if($repost_owner_profile_pic != ""){
                                                ?>      
                                                    <img src="profile/profile_photos/<?php echo $repost_owner_profile_pic ?>" alt="">
                                                <?php
                                                }else{
                                                    ?>
                                                        <img src="images/avater.jpg" alt="">
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="feed-user-name">
                                            <p><?php echo $repost_owner_fullname?></p>

                                            <?php
                                                $period = $re_fetch['timeposted'];
                                            ?>

                                            <small><?php echo time_posted($period)?> | <?php echo $repost_user_fetch['location']?></small>
                                        </div>
                                    </div>
                                </a>

                                <?php // End: Post Owner Profile ?>
                            
                                <input type="text" class="sessionId" value="<?php echo $session?>" hidden>
                                
                            
                            </div>
                
                    
                            <?php // Start: Post Comments  ?>
                        
                            <a href="posts/?mbpc=<?php echo $repost_post_id; ?>&stat=1&all=0&ci=none&visit=<?php echo $session_id ?>">

                            <?php // Start: Post Text ?>

                            <div class="feed-text">
                                <p><?php echo nl2br($repost_post_text, false);?></p>
                            </div>
                            </a>
                    
                            <?php
                            
                                // Start: Post Img or Vid
                                if($repost_post_img != ''){
                                    ?>
                                    <div class="feed-img">
                                        <a href="posts/?mbpc=<?php echo $repost_post_id; ?>&stat=1&all=0&ci=none&visit=<?php echo $session_id ?>">
                                            <img src="create_post/images/<?php echo $repost_post_img ?>" alt="">
                                        </a>
                                    </div>
                                <?php
                                
                                }elseif($repost_post_vid != ''){
                                    ?>
                                    <div class="feed-img">
                                        <div style="position: relative; display: inline-block" class="overlayVid">
                                            
                                            <video controls class="uploadVid" width="100%" height="100%">
                                                <source src="create_post/videos/<?php echo $repost_post_vid ?>" type="video/mp4">
                                                <source src="create_post/videos/<?php echo $repost_post_vid ?>" type="video/ogg">
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
                                        <form action="" id="love_react_form">
                                            <input type="text" name="unique_id" class="session_id" value="<?php echo $session_id ?>" hidden>
                                            <input type="text" name="post_id" id="posst_id" value="<?php echo $repost_post_id?>" hidden>
                                        </form>

                                        <!-- <script>
                                            let post_id = <?php// echo $post_id ?>'

                                            I was working on Bookmark
                                        </script> -->
                                        
                                        <button onclick="postDrop(<?php echo $repost_post_id ?>)" style="background: transparent; cursor: pointer; color: #677db6"><span class="material-icons-sharp">favorite_border</span></button>
                                    
                                        <p id="like_count_general" class="count_likes">
                                            
                                            <?php
                                                
                                                // Fetch Like Count
                                                $sql_likes = mysqli_query($con, "SELECT * FROM love_reaction_table WHERE post_id = '$repost_post_id'");
                                                $row_likes = mysqli_num_rows($sql_likes);
                                                echo $row_likes;
                                                
                                            ?>

                                            
                                            
                                        </p>
                                        
                                    </div>

                                    <div class="feed-span">
                                    <!-- Button for Post reactions pop up -->
                                    <a href="posts/?mbpc=<?php echo $re_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session_id ?>"><span style="cursor: pointer" class="material-icons-sharp">maps_ugc</span></a>
                                        <p>

                                            <?php 
                                                // Fetch numbers of comment
                                                $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$re_fetch['post_id']}' AND comment != ''");
                                                
                                                $comment_row = mysqli_num_rows($sql_reactions);

                                                echo $comment_row;

                                            
                                            ?>
                                        </p>
                                    </div>

                                    <div class="feed-span">
                                        <!-- <a href="posts/repost.php?post_id=<?php //echo $post_id ?>&user_id=<?php //echo $session_id ?>"><span class="material-icons-sharp">autorenew</span></a> -->
                                        <!-- <p>6</p> -->
                                    </div>

                                    
                                </div>
                                
                                <input type="text" class="post_id_bookmark" value="<?php echo $repost_post_id ?>" name="" id="" hidden>
                            </div>

                            
                            <div class="liked-by">
                                <!-- <img src="images/profile-4.jpg" alt=""> -->
                                <!-- <p>Liked by <b><a href="#">Carl Mike</a></b> and 1 other people</p> -->
                            </div>

                        </div>
                        
                        <?php
                    }
                    ?>
                <?php
                }
            ?>  
            </div>
                            
        
            <div class="for-space"></div>


        </div>


        <!-- ====================================Right==================================== -->
        <div class="right">
            <div class="nofications">
                <div class="right-heading">
                    <div>
                        <a href="notifications/?red=1"><h1 style="cursor: pointer">Notifications</h1></a>
                    </div>
                    <div>
                    <?php

                        // Fetch Notification Row For the Red Dot Notification
                        $redQuery = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '{$session}' AND red_dot_not = 0");
                        $dotRow = mysqli_num_rows($redQuery);
                        if($dotRow > 0){
                            ?>
                            <span class="material-icons-sharp aside-span">notifications</span>
                        <?php    
                        }
                    ?>
                        
                    </div>
                </div>
                <div class="all-notification">
                    <?php
                        // Fetch Notifications for Desktop View
                        $Dsql = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '{$session}' ORDER BY id DESC LIMIT 3");


                        while($fetch_notification = mysqli_fetch_assoc($Dsql)){

                            // Fetch the Notification Sender ID and fetch the Id Details from the users Table
                            $sender_id = $fetch_notification['sender_id'];

                            $Ssql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$sender_id'");
                            $sender_details = mysqli_fetch_assoc($Ssql);

                            $sender_fullname = $sender_details['f_name'] . " " . $sender_details['l_name'];
                            ?>
                            <a href="profile/?bup=<?php echo $sender_id?>">
                                <div class="right-notication">
                                    <div style="display: flex; align-items: center; width: 100%;">
                                        <div style="display: flex; align-items: center; width: 100%">
                                            <div class="notification-photo">
                                                <?php if($sender_details['profile_pic'] != ""){
                                                    ?>      
                                                        <img src="profile/profile_photos/<?php echo $sender_details['profile_pic'] ?>" alt="">
                                                    <?php
                                                    }else{
                                                        ?>
                                                        <img src="images/avater.jpg" alt="">
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="notification-details">
                                                <h2><?php echo $sender_fullname?></h2>
                                </a>
                                                <a href="posts/?mbpc=<?php echo $fetch_notification['post_id']?>&stat=1&all=0&ci=<?php echo $fetch_notification['comment_id'] ?>&visit=<?php echo $session_id ?>">
                                                    <p><?php echo $fetch_notification['notification_content'] ?></p>
                                                    <p style="color: #899"><?php echo $fetch_notification['comment'] ?></p>
                                                    <p style="font-size: 0.7rem"><?php echo time_posted($fetch_notification['timesent'])?></p>
                                                </a>

                                                <?php 
                                                    if($fetch_notification['notification_content'] != 'Comment on your Post'){
                                                        ?>
                                                        <div class="friends_accept_btn">
                                                            <button>Accept</button>
                                                            <button>Reject</button>
                                                        </div>
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="active-shape">
                                            <?php 
                                                // Check if the Notification has been clicked
                                                if($fetch_notification['status'] == 0){
                                                    $color = "#31a264";
                                                }else{
                                                    $color = "#555";
                                                }
                                            ?>
                                            
                                            <div class="mobile-chats-online-status">
                                                <span style="color: <?php echo $color ?>; font-size: 1rem" class="material-icons-sharp">circle</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                    <?php
                        }

                    ?>
                </div>
            </div>
            <div class="contacts">
                <div class="right-heading">
                    <h1>Active Contacts</h1>
                </div>

                <div class="active-contacts">
                    <div class="active-users">
                        <a href="#">
                            <div class="aside-user-profile">
                                <div class="rounded-photo online">
                                    <img src="images/profile-4.jpg" alt="">
                                </div>
                                <div class="profile-name">
                                    <h2>Oludowole Olumide</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="active-users">
                        <a href="#">
                            <div class="aside-user-profile">
                                <div class="rounded-photo online">
                                    <img src="images/profile-4.jpg" alt="">
                                </div>
                                <div class="profile-name">
                                    <h2>Oludowole Olumide</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="active-users">
                        <a href="#">
                            <div class="aside-user-profile">
                                <div class="rounded-photo online">
                                    <img src="images/profile-4.jpg" alt="">
                                </div>
                                <div class="profile-name">
                                    <h2>Oludowole Olumide</h2>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
    </main>

    <!-------------------------------------------ALL POP UP------------------------------------------->

    <!-- ================Create Post Form================ -->
    <div class="flex">
        <div class="newpost">
                <div class="new-post-head desktop-class">
                    <h1>Create Post</h1>
                    <span class="material-icons-sharp close-function">close</span>
                </div>
                <hr>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="feed-head">
                        <div class="feed-user">
                            <a href="profile/?bup=<?php echo $session?>">
                            <div class="rounded-photo newpost-img">
                            <?php 
                                if($user_data['profile_pic'] != ""){
                                ?>      
                                    <img src="profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
                                <?php
                                }else{
                                    ?>
                                        <img src="images/avater.jpg" alt="">
                                <?php
                                }
                            ?>
                            </div></a>
                            <div class="feed-user-name">
                                <a href="profile/?bup=<?php echo $_SESSION['unique_id']?>"><p><?php echo $fullname;?></p></a>
                                <select name="desktop_privacy" id="">
                                    <option value="Public">Public</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Only me">Only me</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="new-post-input">
                        <textarea name="text_desktop" id="" placeholder="What's on your mind <?php echo $f_name;?>?"></textarea>
                        <div style="margin-bottom: 1.2rem; margin-top: 1rem;" id="deskPrev" class="preview_images_desk">

                            <div style="text-align: right; color: tomato;" id="clearImg">
                                <p style="cursor: pointer; width: max-width">Remove Image</p>
                            </div>

                            <div style="text-align: right; color: tomato; display: none" onclick="removeVid()" id="clearVid">
                                <p style="cursor: pointer; width: max-width; font-size: 0.8rem">Video inserted - Click here to remove Video</p>
                            </div>
                            
                            <img id="files-ip-1-preview">
                        </div>
                    </div>
                    <div class="new-post-add">
                        <div class="new-post-add-text">
                            <h1>Add to your post</h1>
                        </div>
                        <div class="new-post-span">
                            <label for="uploadFile" class="up"><span title="Add Image" class="material-icons-sharp">collections</span></label>
                            <input type="file" name="gallery_images_desk" style="display: none;" id="uploadFile" onchange="showPreview(event);" accept="image/jpeg, image/png, image/jpg,"/>

                            <label for="uploadFileVid"><span title="Add Video" class="material-icons-sharp">smart_display</span></label>
                            <input type="file" name="gallery_videos_desk" style="display: none;" id="uploadFileVid" onchange="vidPrev()" accept="video/mp4, video/3gp"/>
                            
                            <a href=""><span title="Tag a Friend" class="material-icons-sharp">group_add</span></a>
                        </div>
                    </div>
                    <button type="submit" class="post-btn">Post</button>
            </form>
        </div>
    </div>


</div>
    </div>

<div class="user-profile-page-action">
    <div class="user-profile-action-icons">
        <span class="material-icons-sharp">bookmark</span>
        <p>Bookmark</p>
    </div>
    <div class="user-profile-action-icons">
        <span class="material-icons-sharp">delete</span>
        <p>Delete</p>
    </div>
    <div class="user-profile-action-icons">
        <span class="material-icons-sharp">update</span>
        <p>Edit</p>
    </div>
    <a href="../messenger/chat.php?mbnau=<?php echo $user_id?>"><div class="user-profile-action-icons">
        <span class="material-icons-sharp">message</span>
        <p>Message</p>
    </div></a>
    
    <div class="user-profile-action-icons">
        <button type="button" class="action-btn" onclick="close_react_pop_up()">Close</button>
    </div>
</div>


<div id="more-post-mobile">

    <div id="hideMobileRepost" class="user-profile-action-icons">
        <span class="material-icons-sharp">autorenew</span>
        <p id="p_repost">Repost</p>
    </div>

    <div class="user-profile-action-icons">
        <span class="material-icons-sharp">bookmark</span>
        <p>Save Post</p>
    </div>
    
    <div id="hideView" class="user-profile-action-icons">
        <span class="material-icons-sharp">delete</span>
        <a href="" id="delete"><p>Delete Post</p></a>
    </div>
    
    <div id="hideEdit" class="user-profile-action-icons">
        <span class="material-icons-sharp">edit</span>
        <p id="post_edit_button">Edit Post</p>
    </div>

    <div id="hideEdit_desktop" class="user-profile-action-icons">
        <span class="material-icons-sharp">account_circle</span>
        <p id="user_info_mobile"></p>
    </div>

</div>


<div class="edit-post-mobile" id="edit-post-mobile">
    <textarea name="edit_post" id="input_edit_post_text"></textarea>
    <div class="edit_post_btn">
        <button id="subBtn">Done</button>
    </div>
</div>


<!----------------------POP For Desktop Notifications---------------------->
<div class="notifications">
    <div class="notification-head">
        <span onclick="openNotification()" class="material-icons-sharp">filter_list</span>
    </div>

    <?php 
        // Fetch Notifications for Desktop View
        $Dsql = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '{$_SESSION['unique_id']}' ORDER BY id LIMIT 3");
        
        $row = mysqli_num_rows($Dsql);

        if($row < 1){
            echo "You do not have notifications yet";
        }else{

            while($fetch_notification = mysqli_fetch_assoc($Dsql)){

                // Fetch the Notification Sender ID and fetch the Id Details from the users Table
                $sender_id = $fetch_notification['sender_id'];
    
                $Ssql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$sender_id'");
                $sender_details = mysqli_fetch_assoc($Ssql);
    
                $sender_fullname = $sender_details['f_name'] . " " . $sender_details['l_name'];
            
            ?>
    
            <a href="" class="notification-profile">
                <div class="notification-details">
                    <div class="notification-profile-photo">
                        <?php if($sender_details['profile_pic'] != ""){
                            ?>      
                                <img src="profile/profile_photos/<?php echo $sender_details['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                <img src="images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div>
                    <div class="notification-profile-name">
                        <h1><?php echo $sender_fullname; ?></h1>
                        <p><?php echo $fetch_notification['notification_content']?></p>
                        
                        <?php 
                            // For Time Sent
                            $timesent = strtotime($fetch_notification['timesent']);
                            $present_time = strtotime(date("Y-m-d h:i:sa"));
                            $time_remainder = $present_time - $timesent;
                            
                        ?>
    
                        <small><?php echo time_posted($fetch_notification['timesent'])?></small>
                    </div>
                </div>
                <div class="active-shape">
                    <span class="material-icons-sharp">circle</span>
                </div>
            </a>
    
    
            <?php
            }
        }

        
    ?>

    <!-- <h1>Others</h1> -->
    
</div>

<script>

    // More Option on Post
    function post_Id(fullname, post_id, user_id, session_id, post_text){
        
        // let post_id = post_Id;
        let user_ids = user_id;
        let post_ids = post_id;
        let sessions_id = session_id;
        let post_texts = post_text;
        let fullnames = fullname;

        $(document).ready(function(){
            $("#more-post-mobile").slideToggle(80);
            $("#edit-post-mobile").slideUp(80);
            $("#user_info_mobile").html("Post by "+fullnames)

            $(window).resize(function(){

                if($(window).width() > 640){
                    $("#more-post-mobile").css("display", "none");
                }

            })

            $("#post_edit_button").click(function(){
                $("#edit-post-mobile").slideDown(80);
                $("#input_edit_post_text").html(post_texts);
            })

            // Submit the Post Update if the User made changes to the Text
            $("#subBtn").click(function(){

                text = $("#input_edit_post_text").val();

                // Start Ajax to send post text
                $.ajax("posts/update_post.php?id="+post_ids+"&user_id="+user_ids+"&text="+text, {
                    success: function (data, status, xhr){
                        // Redirect User to Home Page when Post has been successfully updated
                        window.location = "../baechat";
                    }
                });
            })


            if(user_ids == sessions_id){
                $("#hideView").css("display", "flex");
                $("#hideEdit").css("display", "flex");

                // Set the HREF Delete Attr to the delete link
                $("#delete").attr("href", "posts/delete_post.php?post_id="+post_ids + "&session_id="+sessions_id + "&user_id="+user_ids);

            }else if(user_ids != sessions_id){
                $("#hideView").css("display", "none");
                $("#hideEdit").css("display", "none");
            }
        })
        
    }





    
    // More Option on RePost 
    function post_Id_mobile_repost(fullname, post_id, user_id, session_id, post_text, repost){
        
        // let post_id = post_Id;
        let user_ids = user_id;
        let post_ids = post_id;
        let sessions_id = session_id;
        let post_texts = post_text;
        let fullnames = fullname;

        $(document).ready(function(){
            $("#more-post-mobile").slideToggle(80);
            $("#edit-post-mobile").slideUp(80);
            $("#user_info_mobile").html("Post by "+fullnames)

            $(window).resize(function(){

                if($(window).width() > 640){
                    $("#more-post-mobile").css("display", "none");
                }

            })

            $("#post_edit_button").click(function(){
                $("#edit-post-mobile").slideDown(80);
                $("#input_edit_post_text").html(post_texts);
            })

            // Submit the Post Update if the User made changes to the Text
            $("#subBtn").click(function(){

                text = $("#input_edit_post_text").val();

                // Start Ajax to send post text
                $.ajax("posts/update_post.php?id="+post_ids+"&user_id="+user_ids+"&text="+text, {
                    success: function (data, status, xhr){
                        // Redirect User to Home Page when Post has been successfully updated
                        window.location = "../baechat";
                    }
                });
            })

            // Post Mobile Repost
            $("#hideMobileRepost").css("display", "none");

            if(user_ids == sessions_id){
                $("#hideView").css("display", "flex");
                $("#hideEdit").css("display", "none");

                // Set the HREF Delete Attr to the delete link
                $("#delete").attr("href", "posts/delete_repost.php?post_id="+repost + "&session_id="+sessions_id + "&user_id="+user_ids);

            }else if(user_ids != sessions_id){
                $("#hideView").css("display", "none");
                $("#hideEdit").css("display", "none");
            }
        })
        
    }




    // Desktop Function
    function post_more_desktop(fullname, post_id, user_id, session_id, post_text){
        let user_ids = user_id;
        let session_ids = session_id;
        let post_ids = post_id;

        $(document).ready(function(){
            $("#more-post-desktop").slideToggle(80);
            $("#more-post-desktop").css("display", "block");
            $("#user_info").html("Post by <b><a href='profile/?bup="+user_ids+"&upd=0'>"+fullname+"</a></b>");

            // Display Edit Button
            $("#post_edit_button_desktop").css("display", "block");
            $("#hideSpan").css("display", "block");

            if(user_ids == session_ids){
                $("#hideView_desktop2").css("display", "flex");
                $("#hideEdit_desktop2").css("display", "flex");
                $("#hideSave").css("display", "none");
                // Set the HREF Delete Attr to the delete link
                $("#delete_desktop").attr("href", "posts/delete_post.php?post_id="+post_ids + "&session_id="+session_ids + "&user_id="+user_ids);
            }else if(user_ids != session_ids){
                $("#hideView_desktop2").css("display", "none");
                $("#hideEdit_desktop2").css("display", "none");
                $("#hideSave").css("display", "flex");
            }



            // Hide Desktop Post More Option When screen size is greater 640 Media Query
            $(window).resize(function(){

                if($(window).width() <= 640){
                    $("#more-post-desktop").css("display", "none");
                }

            })

            
        })

    }

    

    // Desktop Function
    function post_more_desktop_repost(fullname, post_id, user_id, session_id, post_text, repost){
        let user_ids = user_id;
        let session_ids = session_id;
        let post_ids = post_id;

        $(document).ready(function(){
            $("#more-post-desktop").slideToggle(80);
            $("#more-post-desktop").css("display", "block");
            $("#user_info").html("Post by <b><a href='profile/?bup="+user_ids+"&upd=0'>"+fullname+"</a></b>");
            // Hide the Edit Button
            $("#post_edit_button_desktop").css("display", "none");
            $("#hideSpan").css("display", "none");

            if(user_ids == session_ids){
                $("#hideView_desktop2").css("display", "flex");
                $("#hideEdit_desktop2").css("display", "none");
                $("#hideRepost").css("display", "none");

                // Set the HREF Delete Attr to the delete link
                $("#delete_desktop").attr("href", "posts/delete_repost.php?post_id="+repost + "&session_id="+session_ids + "&user_id="+user_ids);
            }else if(user_ids != session_ids){
                $("#hideRepost").css("display", "flex");
                $("#hideView_desktop2").css("display", "none");
                $("#hideEdit_desktop2").css("display", "flex");
            }



            // Hide Desktop Post More Option When screen size is greater 640 Media Query
            $(window).resize(function(){

                if($(window).width() <= 640){
                    $("#more-post-desktop").css("display", "none");
                }

            })

            
        })

    } 


    


    // Repost 
 
    function edit_post(post_id, session_id, post_text){

        post_ID = post_id;
        session_ID = session_id;
        post_TEXT = post_text;

        $(document).ready(function(){
            $("#edit-post-mobile").slideToggle(80);

            $("#input_edit_post_text").html(post_ID);

        })


    }



</script>


<script src="newjs/carosel.js"></script>
<script src="newjs/image_preview.js"></script>
<script src="newjs/love_reactions.js"></script>
<script src="javascript/videoPlayer.js"></script>
<script src="javascript/video_preview.js"></script>
<script src="javascript/script.js"></script>
<script src="javascript/post.js"></script>
<script src="javascript/openCloseNotification.js"></script>
<script src="javascript/darkmode.js"></script>
<script src="javascript/darkmode2.js"></script>
<script src="javascript/mobilemenu.js"></script>
<script src="javascript/mobile_create_post.js"></script>
<!-- Like Button Function -->
<script src="javascript/likebutton.js"></script>
</body>
</php>