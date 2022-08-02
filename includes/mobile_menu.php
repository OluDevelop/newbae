<div class="mobile-menu">
    <a href="../profile/?bup=<?php echo $_SESSION['unique_id']?>&upd=0" class="mobile-menu-profile"> 
        <div class="mobile-menu-profile-photo">
            <?php if($user_data['profile_pic'] != ""){
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
        <div class="mobile-menu-profile-name">
            <p><?php echo $fullname?></p>
        </div>
    </a>

    <div><a href="../friends">
        <span class="material-icons-sharp">people</span>
        <p>Friends</p>
    </a></div>

    <div><a href="../communities">
        <span class="material-icons-sharp">groups</span>
        <p>Groups</p>
    </a></div>

    <div><a href="../marketplace">
        <span class="material-icons-sharp">storefront</span>
        <p>Marketplace</p>
    </a></div>

    <div><a href="../bookmarks">
        <span class="material-icons-sharp">bookmark</span>
        <p>Bookmark</p>
    </a></div>

    <div><a href="../messenger">
        <span class="material-icons-sharp">chat</span>
        <p>Messenger</p>
    </a></div>

    <div><a href="../notifications">
        <span class="material-icons-sharp">notifications</span>
        <p>Notification</p>
    </a></div>

    <div><a href="../settings">
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
    <div><a href="../helpandsupport">
        <span class="material-icons-sharp">help</span>
        <p><span style="color:rgb(255, 118, 94); font-size: 1rem">BaE</span> Help & Support</p>
    </a></div>
    <div><a href="../authentications/logout.php">
        <span class="material-icons-sharp">logout</span>
        <p>Logout</p>
    </a></div>
    <div class="mobile-menu-close-btn">
        <span class="material-icons-sharp mobile-menu-close-btn">filter_list</span>
    </div>
</div>