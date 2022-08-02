<?php
    include "../includes/auth_users.php";
    require "process_post.php";
?>

<!-- jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        
        $("#textArea").on("key", function(e){
            
            if(key === 13){
                alert("same");
            }
        });

    });
</script>

<?php include "../includes/g_header.php" ?>
<body>

<!------------------------------For Mobile Create Post------------------------------>
<div class="mobile-create-post">
<form method="POST" enctype="multipart/form-data" autocomplete="off">
    <div class="mobile-create-post-head">
        <div>
            <span class="material-icons-sharp" onclick="history.back()">arrow_back</span>
            <h1>Create post</h1>
        </div>
        <button type="submit" class="posts-btn">Post</button>
    </div>

    <div class="mobile-create-post-profile">
        <div class="mobile-create-post-profile-img">
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

        <div class="mobile-create-post-profile-name">
            <h1><?php echo $fullname;?></h1>
            <select name="privacy" id=""> 
                <option value="Anyone">Anyone</option>
                <option value="Friends">Friends</option>
                <option value="Only me">Only me</option>
            </select>
        </div>
    </div>

    <textarea name="post_text" id="textArea" placeholder="What's on your mind <?php echo $f_name;?>?"></textarea>
    
    <div style="margin-bottom: 5rem;" class="preview_images">
        <img id="files-ip-1-preview">
            
        <div style="text-align: right; color: tomato;" id="clearImg" onclick="clearImgName()">
            <p style="cursor: pointer; width: max-width">Remove Image</p>
        </div>

    </div>
</div>


<div class="mobile-create-post-bottom">
    <div>

        <label for="imageFile"><span class="material-icons-sharp">camera</span></label>
        <input type="file" name="image_capture" style="display: none;" id="imageFile" capture="user" onchange="showPreviewCam(event);" accept="image/*">

        <!-- <label for="videoFile"><span class="material-icons-sharp">videocam</span></label>
        <input type="file" name="video_capture" style="display: none;" id="videoFile" capture="user" accept="video/*"> -->

        <label for="uploadFileVid"><span title="Add Video" class="material-icons-sharp">smart_display</span></label>
        <input type="file" name="gallery_videos_desk" style="display: none;" id="uploadFileVid" onchange="vidPrev()" accept="video/mp4, video/3gp"/>

        <label for="uploadFile" class="up"><span class="material-icons-sharp">collections</span></label>
        <input type="file" name="gallery_images" style="display: none;" id="uploadFile" onchange="showPreviewFile(event);" accept="image/jpeg, image/png, image/jpg,"/>
        <a href=""><span title="Tag a Friend" class="material-icons-sharp">group_add</span></a>

    </div>
    <button type="submit" name="sub"><span class="material-icons-sharp">send</span></button>
</div>


</form>




<!-- Activate the Dark mode on this page -->
<div id="dark-btn" style="display: none;">
    <span></span>
</div>


<script src="../newjs/image_preview_mobile.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
<script src="../javascript/darkmode.js"></script>
</body>
</html> 