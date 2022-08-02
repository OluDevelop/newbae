<?php 

    // Fetch post Reactions
    $reaction_query = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '$post_id' AND comment != ''");

    $count = mysqli_num_rows($reaction_query);

    if($count > 0){
        while($fetch_reactions = mysqli_fetch_assoc($reaction_query)){

            // Fetch engagers details
            $sql_engage = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$fetch_reactions['unique_id']}'");
            $user_details = mysqli_fetch_assoc($sql_engage);
            $fullname = $user_details['f_name'] . ' ' . $user_details['l_name'];
    
            ?>
    
                <div class="user-post-post-details" style="align-items: flex-end;">
                    <div class="user-post-profile-photo">
                    <?php 
                        if($user_details['profile_pic'] != ""){
                        ?>      
                            <img src="../profile/profile_photos/<?php echo $user_details['profile_pic'] ?>" alt="">
                        <?php
                        }else{
                            ?>
                                <img src="../images/avater.jpg" alt="">
                        <?php
                        }
                    ?>
                    </div>
    
                    <div class="user-post-post-text">
                        <div class="user-post-content">
                            <p><?php echo $fetch_reactions['comment']; ?></p>
                            <div class="comment-post-actions">
                                <span class="material-icons-sharp" onclick="likeIt()">favorite_border</span> <span>2</span>
                                <p id="likeNo">Like</p>
                            </div>
                        </div>
                        <a href="../profile/?bup=<?php echo $user_details['unique_id']?>"><h1 style="font-size: 0.8rem; margin-top: 0.2rem"><?php echo $fullname;?></h1></a>
                    </div>
                    
                </div>
    
            <?php
    
        }
    }

    
?>






