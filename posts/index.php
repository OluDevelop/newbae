<?php
    include "../includes/auth_users.php";
    require("comment_process.php");

    if($_REQUEST['mbpc']){
        $post_id = $_REQUEST['mbpc'];

        // Fetch the Post Details
        $sql = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id'");
        $post_fetch = mysqli_fetch_assoc($sql);

        // Fetch post owner details from the users table
        $own_query = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$post_fetch['unique_id']}'");
        $post_owner_details = mysqli_fetch_assoc($own_query);

        $fullname = $post_owner_details['f_name'] . ' ' . $post_owner_details['l_name'];

        // Update the Post Status if stat is in URL
        if($_REQUEST['visit'] == $_SESSION['unique_id']){
            if($_REQUEST['stat'] == 1){
                $comment_id = $_REQUEST['ci'];
                $updateQuery = mysqli_query($con, "UPDATE notifications SET status = 1 AND red_dot_not = 1 WHERE post_id = '$post_id' AND comment_id = '$comment_id'");
            }

            if($_REQUEST['all'] == true){
                $comment_id = $_REQUEST['ci'];
                $updateQuery = mysqli_query($con, "UPDATE notifications SET status = 1 WHERE post_id = '$post_id'");
            }
        }
        

    }else{
        header("Location: ../");
    }


?>


<!------------- Include Header ----------------->
<?php include "../includes/g_header.php" ?>


<body>
<script>
    window.onload = ()=>{
        const focusArea = document.getElementById("focusHere");
        focusArea.focus();
    }
</script>

<!-- User Post For Desktop -->

<?php 

    // Fetch Post Details
    $DPSql = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id' LIMIT 1");
    $post_desk_fetch = mysqli_fetch_assoc($DPSql);

    // Fetch The Poster Details
    $DPDSql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}' LIMIT 1");
    $user_desk_fetch = mysqli_fetch_assoc($DPDSql);

    $desk_user_fullname = $user_desk_fetch['f_name'] . " " . $user_desk_fetch['l_name'];

    // Post reactions

?>

<div class="user-profile-post-desktop">
    <div class="user-profile-post-desktop-left">
        <span class="material-icons-sharp sscsc" onclick="history.back()">arrow_left</span>
        <div class="user-post-photo">
            <center>
                <?php
                    if($post_fetch['post_img'] != ''){
                    ?>
                        <img src="../create_post/images/<?php echo $post_fetch['post_img'] ?>" alt="">
                    <?php
                    }elseif($post_fetch['post_vid'] != ''){
                    ?>
                        <video controls class="uploadVid" width="100%" height="100%">
                            <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/mp4">
                            <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/ogg">
                            Your Browser Does Not Support the Video Tag
                        </video>
                    <?php
                    }
                ?>
            </center>
            <div class="user-profile-page-actions">
                <div class="feed-actions">
                    <div class="feed-action">
                        <div class="feed-span" onclick="reaction_actions()">
                            <span class="material-icons-sharp">favorite_border</span>
                            <p>2</p>
                        </div>
                        <div class="feed-span">
                            <span class="material-icons-sharp">maps_ugc</span>
                            <p>
                                <?php 
                                    // Fetch numbers of comment
                                    $sql_reactions = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '{$post_desk_fetch['post_id']}' AND comment != ''");
                                    
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
            </div>
        </div>
    </div>

    <div class="user-profile-post-desktop-right">
        <div class="user-post-post-details">
            <div class="user-post-profile-photo">
                <?php 
                    if($user_desk_fetch['profile_pic'] != ""){
                    ?>      
                        <img src="../profile/profile_photos/<?php echo $user_desk_fetch['profile_pic'] ?>" alt="">
                    <?php
                    }else{
                        ?>
                            <img src="../images/avater.jpg" alt="">
                    <?php
                    }
                ?>
            </div>
    
            <div class="user-post-post-text">
                <a href="../profile/"><h1><?php echo $desk_user_fullname ?></h1></a>
                <div class="user-post-content font-size">
                    <p id="post-length">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi consectetur dolorum alias, sed voluptates molestias distinctio amet, 
                        mollitia nisi porro quos adipisci accusamus quidem <span id="more2"> officia fugit ipsum maxime non blanditiis? Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Modi consectetur dolorum alias, sed voluptates molestias distinctio amet, mollitia nisi porro quos adipisci accusamus
                            quidem officia fugit ipsum maxime non blanditiis?</p></span>
                            <button id="showMore2" onclick="showMore2()">Read More...</button>
                            <button id="hideBtn2" onclick="showLess2()">...Read Less</button>
                </div>
            </div>
            
        </div>
    
        <div class="user-profile-page-comments">
            <?php
                // Post Reactions
                $sql_post = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '$post_id' AND comment != ''");
                $sql_post_fetch = mysqli_fetch_assoc($sql_post);
                $commenter_unique_id = $sql_post_fetch['unique_id'];
            ?>

            <div id="desktopComment">
                
            </div>
            
        </div>
    
        <div class="user-profile-page-actions-comment">
            <div class="user-profile-page-actions-comment-photo">
                <?php 
                    if($user_desk_fetch['profile_pic'] != ""){
                    ?>      
                        <img src="../profile/profile_photos/<?php echo $user_desk_fetch['profile_pic'] ?>" alt="">
                    <?php
                    }else{
                        ?>
                            <img src="../images/avater.jpg" alt="">
                    <?php
                    }
                ?>
            </div>
            <textarea name="" id="focusHere2" placeholder="Comment on post" class="increase"></textarea>
            <span class="material-icons-sharp">send</span>
        </div>
    </div>
</div>


<!-- User Post For Mobile -->
<div class="user-profile-post">
    <div id="scrollBottom">
        <div id="element_scroll_height">
            <div class="user-profile-head" style="position: relative;">
                <span class="material-icons-sharp" onclick="history.back()">west</span>
                <div>
                    <h1><?php echo $fullname;?></h1>
                </div>
            </div>

            <div class="user-post-photo">
                <?php
                    if($post_fetch['post_img'] != ''){
                    ?>
                        <img src="../create_post/images/<?php echo $post_fetch['post_img'] ?>" alt="">
                    <?php
                    }elseif($post_fetch['post_vid'] != ''){
                    ?>
                        <video controls class="uploadVid" width="100%" height="100%">
                            <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/mp4">
                            <source src="../create_post/videos/<?php echo $post_fetch['post_vid'] ?>" type="video/ogg">
                            Your Browser Does Not Support the Video Tag
                        </video>
                    <?php
                    }
                ?>
            </div>

            <div class="user-post-post-details">

                <a href="../profile/?bup=<?php echo $post_fetch['unique_id']?>">
                    <div class="user-post-profile-photo">
                        <?php 
                            if($post_owner_details['profile_pic'] != ""){
                            ?>      
                                <img src="../profile/profile_photos/<?php echo $post_owner_details['profile_pic'] ?>" alt="">
                            <?php
                            }else{
                                ?>
                                    <img src="../images/avater.jpg" alt="">
                            <?php
                            }
                        ?>
                    </div>

                    <div class="user-post-post-text">
                        <h1><?php echo $fullname ?></h1>
                </a>

                    <div class="user-post-content">
                        <p><?php echo $post_fetch['post_text'] ?></p>
                    </div>
                    <!-- <div class="user-post-content">
                        <p id="post-length">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi consectetur dolorum alias, sed voluptates molestias distinctio amet, 
                            mollitia nisi porro quos adipisci accusamus quidem <span id="more"> officia fugit ipsum maxime non blanditiis? Lorem ipsum dolor sit amet consectetur 
                            adipisicing elit. Modi consectetur dolorum alias, sed voluptates molestias distinctio amet, mollitia nisi porro quos adipisci accusamus
                                quidem officia fugit ipsum maxime non blanditiis?</p></span>
                                <button id="showMore" onclick="showMore()">Read More..</button>
                                <button id="hideBtn" onclick="showLess()">..Read Less</button>
                    </div> -->
                </div>
                
            </div>

            <div class="user-profile-page-actions">
                <div class="feed-actions">
                    <div class="feed-action">
                        <div class="feed-span">
                            <span class="material-icons-sharp like_icon">favorite_border</span>
                            <p class="like_count"></p>
                            <input type="text" class="session_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                            <input type="text" class="post_id" value="<?php echo $post_fetch['post_id'] ?>" hidden>
                        </div>

                        
                        <div class="feed-span">
                        <a href="posts/?mbpc=<?php echo $post_fetch['post_id']; ?>"><span class="material-icons-sharp">maps_ugc</span></a>
                        <form action="" class="count_comments">
                            <input type="text" name="post_id" value="<?php echo $post_id ?>" hidden>
                        </form>
                            <p id="count"></p>
                        </div>


                        <div class="feed-span">
                            <span class="material-icons-sharp">share</span>
                            <p>6</p>
                        </div>
                    </div>
                    <a href="#"><span class="material-icons-sharp save-icon">turned_in</span></a>
                </div>
            </div>
        </div>


        <div id="getComment" class="user-profile-page-comments">
            
        </div>
    </div>


    <?php 

        // Post Comment Section

        // Fetch the logged in user profile details
        $sql_fetch = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");

        $fetch = mysqli_fetch_assoc($sql_fetch);

    ?>
    <form action="" class="form_comment">

        <div class="user-profile-page-actions-comment-mobile">
            <div class="user-profile-page-actions-comment-photo">
            <?php 
                if($fetch['profile_pic'] != ""){
                ?>      
                    <img src="../profile/profile_photos/<?php echo $fetch['profile_pic'] ?>" alt="">
                <?php
                }else{
                    ?>
                        <img src="../images/avater.jpg" alt="">
                <?php
                }
            ?>
            </div>
            <input type="text" name="post_id" value="<?php echo $post_id ?>" hidden>
            <textarea name="comment" id="focusHere" placeholder="Comment on post" class="increase"></textarea>
            <button style="background: transparent;" class="ajax_submit"><span class="material-icons-sharp">send</span></button>
        </div>

    </form>
</div>


    
<!-- Dark and Light Mode Activation -->
<div id="dark-btn2" style="display: none;">
    <span></span>
</div>

<div id="dark-btn" style="display: none;">
    <span></span>
</div>

<script>




    var likeBtn = document.querySelector(".like_icon");
    var like_count = document.querySelector(".like_count");

    var post_id = document.querySelector(".post_id");
    var session_id = document.querySelector(".session_id");

    post_num = post_id.value;
    session_num = session_id.value;


    // Check if this user has already liked this post
    onload = ()=> {
        // Start Ajax
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../posts/check_process.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data == 'true'){
                        likeBtn.classList.toggle("feed-span_span_color_change");
                    }
                }
            }
        }

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("post_id="+post_num);
    }


    // Allow Users to Like the Post
    likeBtn.onclick = ()=>{

        // Start Ajax
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../posts/react_process.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    
                }
            }
        }

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("post_id="+post_num);

        likeBtn.classList.toggle("feed-span_span_color_change");
    }


    // Get the number of post like
    setInterval(() => {
        
        // Start Ajax
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../posts/count_likes.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    like_count.innerHTML = data;
                }
            }
        }

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("post_id="+post_num);

    }, 200);

</script>




<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>  
<script src="../javascript/post.js"></script>
<script src="../newjs/comment.js"></script>
<script src="../newjs/count_comment.js"></script>
</body> 
</html>