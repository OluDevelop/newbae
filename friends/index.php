<?php
    include "../includes/auth_users.php";
?>


<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>
<body>

<!--------------Include Desktop Nav --------------->
<?php include "../includes/desktop_nav.php" ?>

<!---------------- Include Mobile Page Header --------------->
<?php include "../includes/mobile_page_header.php" ?>


<!---------------------Mobile Friends Top Options--------------------->
<!-- <div class="mobile-top-options">
    <span class="material-icons-sharp last off" onclick="openTopOption()">chevron_left</span>
    <span class="material-icons-sharp last" onclick="closeTopOption()">chevron_right</span>
    <a href="../friends">
        <div class="option1">
        <span class="material-icons-sharp active">diversity_3</span>
    </div></a>
    <a href="friends_list.php">
    <div class="option1">
        <span class="material-icons-sharp">diversity_1</span>
    </div></a>
    <a href="request.php">
    <div class="option1">
        <span class="material-icons-sharp">group_add</span>
    </div></a>
</div> -->




<div class="friends">

<div class="friends-left">
    <div class="friends-left-head">
        <h1>Friends</h1>
        <div class="friends-left-head-profile-img">
            <img src="../images/avater.jpg" alt="">
        </div>
    </div>

    <div class="friends-left-head-lists active">
        <div>
            <span class="material-icons-sharp">diversity_3</span>
            <p>Suggested Friends</p>
        </div>
        <span class="material-icons-sharp hide">chevron_right</span>
    </div>
    
    <a href="friends_list.php"><div class="friends-left-head-lists">
        <div>
            <span class="material-icons-sharp">diversity_1</span>
            <p>Your Friends</p>
        </div>
        <span class="material-icons-sharp hide">chevron_right</span>
    </div></a>
    
    <a href="request.php">
    <div class="friends-left-head-lists">
    <div>
        <span class="material-icons-sharp">group_add</span>
        <p>Friend Requests</p>
    </div>
    <span class="material-icons-sharp hide">chevron_right</span>
    </div>
    </a>

</div>


<div class="friends-right">

    <div class="switch_btw_friends">
        <label><a href="friends_list.php">Connections</a></label>
        <label><a href="request.php">Requests</a></label>
    </div>

    <div class="friends-right-head">
        <h1>Suggested Friends</h1>
    </div>
    <div class="friends-right-all-cards">
        <div class="friends-right-cards">
            <div class="friends-right-cards-wall-photo">
                <img src="../images/feed-2.jpg" alt="">
            </div>
            <center>
                <div class="friends-right-cards-profile-photo">
                    <img src="../images/profile-2.jpg" alt="">
                </div>
                <div class="friends-right-cards-texts">
                    <h1>Mercy Peace</h1>
                    <p>6 mutual friends</p>
                    <button type="button" class="friends-card-btn">Connect</button>
                </div>
            </center>
        </div>
    </div>
</div>


</div>


</div>

</div>



<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>

<!-----------Include Mobile Nav Menu----------->
<?php include "../includes/nav_menu_mobile.php"?>

<!-----------Include Desktop Notification Pop----------->
<?php include "../includes/desktop_notification_pop.php"?>


<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
<script src="../javascript/mobile-top-options-close.js"></script>
<script src="../javascript/notification.js"></script>
</body>
</html>