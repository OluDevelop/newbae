<?php
    include "../includes/auth_users.php";
?>

<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>

<?php 
    // Fetch Chats 
    if(isset($_REQUEST['mbnau'])){
        $incoming_chat_id = $_REQUEST['mbnau'];

        // Fetch the user with this ID
        $sql = mysqli_query($con, "SELECT * FROM users WHERE `unique_id` = '$incoming_chat_id'");

        if($sql){
            $user_data = mysqli_fetch_assoc($sql);
        }

    }else{
        header("location: index.php");
    }

?>


<body>
    
<div class="mobile-chat-page">

    <div class="mobile-chat-page-head">

        <div class="mobile-chat-page-head-div1">
            <div class="mobile-chat-page-head-back" onclick="history.back()">
                <span class="material-icons-sharp">keyboard_backspace</span>
                <div class="mobile-chat-page-head-back-photo">
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
            </div>
            <div class="mobile-chat-page-head-friend-name">
                <a href="../profile/?bup=<?php echo $user_data['unique_id']?>&upd=0"><p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p></a>
                <small>Active</small>
            </div>
        </div>

        <span class="material-icons-sharp">more_vert</span>
    </div>

    <div class="mobile-chat-box">
        
    </div>


    <form action="" class="mobile-message-input">
        <input type="text" name="incoming_id" value="<?php echo $incoming_chat_id;?>" hidden>
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
        <input type="text" class="mobile-message-input-input" name="message" class="input-field" name="" id="" placeholder="Type a message here..." autocomplete="off">
        <button><span class="material-icons-sharp">telegram</span></button>
    </form>

</div>



<!-----------------------Dark and Light Mode Actication----------------------->
<div id="dark-btn" style="display: none;">
    <span></span>
</div>

<script src="../newjs/chat.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/mobilemenu.js"></script>
</body>
</html>