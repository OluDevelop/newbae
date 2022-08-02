<?php

while($user_data = mysqli_fetch_assoc($sql)){
    ?>
    <a href="chat.php?mbnau=<?php echo $user_data['unique_id'];?>">
        <div class="mobile-chats">
            <div class="mobile-chats-friends">
                <div class="mobile-chats-profile-photo">
                    <img src="../images/profile-11.jpg" alt="">
                </div>

                <div class="mobile-chats-user-details">
                    <p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p>
                    <small>Sample message</small>
                </div>
            </div>
            
            <div class="mobile-chats-online-status">
                <span class="material-icons-sharp">circle</span>
            </div>
        </div>
    </a>
<?php    
}

?>