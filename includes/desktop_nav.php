<!---------------------------Nav For Desktop--------------------------->
<nav class="desktop">
    <div class="container">
        <div class="nav-left">
            <div class="rounded-photo logo">
                <a href="../"><img src="../images/newBaeLogo.png" alt=""></a>
            </div>
            <div class="search-input">
                <span class="material-icons-sharp">search</span>
                <input type="search" placeholder="Search a friend">
            </div>
        </div>
        <div class="nav-center">
            <ul>
                <li><a href="../">
                    <span class="material-icons-sharp">home</span>
                </a></li>
                <li><a href="../friends">
                    <span class="material-icons-sharp">people_outline</span>
                </a></li>
                <li><a href="#">
                    <span class="material-icons-sharp">textsms</span>
                </a></li>
            </ul>
        </div>

        <div class="nav-right">
            <a href="../profile?bup=<?php echo $_SESSION['unique_id']?>"><div class="nav-user-profile">
                <div class="rounded-photo online">
                    <?php 
                        // Fetch Logged in User Profile Pic
                        $logSql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
                        $fetch = mysqli_fetch_assoc($logSql);
                    ?>

                    <?php if($fetch['profile_pic'] != ""){
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
                <div class="profile-name">
                    <h1><?php echo $f_name;?></h1>
                </div>
            </div></a>
            <ul>
                <li onclick="notification_toggle()">
                    <span class="material-icons-sharp">notifications</span>
                </li>
                <li class="drop-arrow" onclick="settings_menu_toggle()">
                    <span class="material-icons-sharp">arrow_drop_down</span>
                </li>
            </ul>
        </div>

        <!-------------------------Setting Menu------------------------->
        <div class="settings-menu">
            <div class="settings-menu-inner">
                <div class="aside-user-profile">
                    <div class="rounded-photo online">
                        <?php if($fetch['profile_pic'] != ""){
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
                    <div class="profile-name">
                        <h2><?php echo $fullname ?></h2>
                    </div>
                </div>
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
                <a href="../authentications/logout.php"><div class="setting-links">
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
