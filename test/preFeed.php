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

                while($fetch_post = mysqli_fetch_assoc($fetch_post_query)){

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


                <div class="feedRepost">

                    <?php
                        // Check if in current post there is repost as true

                        // Fetch Repost from the Posts Table
                        $repost_query = mysqli_query($con, "SELECT * FROM posts WHERE repost = '1'");
                        $repost_query_row = mysqli_num_rows($repost_query);
                        
                        if($repost_query_row > 0){

                            // Fetch While
                            $repost_query_fetch = mysqli_fetch_assoc($repost_query);
                            
                            // Post Table Details
                            $repost_reposter_ID = $repost_query_fetch['unique_id'];
                            $repost_owner_ID = $repost_query_fetch['owner_id'];
                            $repost_post_id = $repost_query_fetch['post_id'];
                            $repost_post_text = $repost_query_fetch['post_text'];
                            $repost_re_post_ID = $repost_query_fetch['re_post_id'];
                            $repost_post_img = $repost_query_fetch['post_img'];
                            $repost_post_vid = $repost_query_fetch['post_vid'];


                            // ================== Fetch the Owner User INFO
                            $repost_user_query = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$repost_owner_ID'");
                            $repost_user_fetch = mysqli_fetch_assoc($repost_user_query);

                            // Owner Details
                            $repost_owner_fullname = $repost_user_fetch['f_name'] . " " . $repost_user_fetch['l_name'];
                            $repost_owner_timeposted = $repost_query_fetch['timeposted'];
                            $repost_owner_profile_pic = $repost_user_fetch['profile_pic'];

                            // ================== Fetch the Reposter User INFO
                            $repost_reposter_query = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$repost_reposter_ID'");
                            $repost_reposter_fetch = mysqli_fetch_assoc($repost_reposter_query);

                            // Reposter Details
                            $repost_reposter_fullname = $repost_reposter_fetch['f_name'] . " " . $repost_reposter_fetch['l_name'];
                            $repost_reposter_timeposted = $repost_query_fetch['timeposted2'];
                            $repost_reposter_profile_pic = $repost_reposter_fetch['profile_pic'];

                            $session_id = $_SESSION['unique_id'];
                            

                
                                ?>

                                    <div style="margin-bottom: 2rem" class="feed-head">
                                        <?php // Start: Post Owner Profile ?>
                                        <a href="profile/?bup=<?php echo $repost_reposter_ID ?>&upd=0">
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
                                                    <p><?php echo $repost_reposter_fullname?></p>

                                                    <?php
                                                        $period = $repost_query_fetch['timeposted2'];
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
                                                        $period = $repost_query_fetch['timeposted'];
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
                                            <a href="posts/?mbpc=<?php echo $repost_query_fetch['post_id']; ?>&stat=1&all=0&ci=none&visit=<?php echo $session_id ?>"><span style="cursor: pointer" class="material-icons-sharp">maps_ugc</span></a>
                                                <p>

                                                    <?php 
                                                        // Fetch numbers of comment
                                                        $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$repost_query_fetch['post_id']}' AND comment != ''");
                                                        
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

                                <?php

                        };

                    ?>
                </div>
                <?php
                }
            ?>  
            </div>