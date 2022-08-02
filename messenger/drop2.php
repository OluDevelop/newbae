<?php
    include "../includes/auth_users.php";
?>

<!------------------ Include Header ---------------->
<?php include "../includes/g_header.php" ?>


<body>

    <div class="mobile-chat-area">

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
        <div class="mobile-chat-top">
            <div class="mobile-chat-top-profile">
                <span class="material-icons-sharp" onclick="history.back()">keyboard_backspace</span>
                <a href="../profile/index.php" style="display: flex">
                <div class="mobile-chat-top-profile-photo">
                    <img src="../images/profile-11.jpg" alt="">
                </div>
                <div class="mobile-chat-top-profile-details">
                    <p><?php echo $user_data['f_name']; echo " "; echo $user_data['l_name'];?></p>
                    <small>Active</small>
                </div></a>
            </div>
            <span class="material-icons-sharp">more_vert</span>
        </div>

        <div class="mobile-chat-box">
            <div class="m-chat mobile-outgoing-chat">
                <div class="mobile-chat-details">
                    <p>Lorem ipsum consectetur</p>
                </div>
            </div>
            <div class="m-chat mobile-incoming-chat">
                <img src="../images/profile-11.jpg" alt="">
                <div class="mobile-chat-details">
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            
        
        </div>
        <form action="" class="mobile-typing-area">
            <input type="text" name="incoming_id" value="<?php echo $incoming_chat_id;?>" hidden>
            <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
            <input type="text" name="message" class="input-field" name="" id="" placeholder="Type a message here...">
            <button><span class="material-icons-sharp">telegram</span></button>
        </form>
    </div>




<!-----------------------Dark and Light Mode Actication----------------------->
<div id="dark-btn" style="display: none;">
    <span></span>
</div>

<!-- <script src="../newjs/chat.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/mobilemenu.js"></script> -->
</body>
</body>

</html>
