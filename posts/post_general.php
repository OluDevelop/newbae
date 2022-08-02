<div class="feed">
<?php if($fetch_post['repost'] == "1"){
        ?>
            <div class="feed-head" style="margin-bottom: 2rem;">
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

                    <small><?php echo time_posted($period)?></small>
                </div>
            </div>
        </a>
        <?php // End: Post Owner Profile ?>
        
        <input type="text" class="sessionId" value="<?php echo $session?>" hidden>
        <div class="postMoreOptionDesktop"><span class="material-icons-sharp">more_horiz</span></div>

        <div onclick="post_repost('<?php echo $post_id?>', '<?php echo $user_id ?>', '<?php echo $session_id ?>', '<?php echo $fetch_post['post_text'] ?>')" class="postMoreOption"><span class="material-icons-sharp">more_horiz</span></div>
    </div>
    <?php
    }
    ?>

    
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
                <span class="material-icons-sharp">autorenew</span>
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