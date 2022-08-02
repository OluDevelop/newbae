<!-----------------------------Nav For Mobile----------------------------->
<div class="mobile-container">
    <div class="mobile">
            <div><a href="../">
                <span class="material-icons-sharp">home</span>
            </a></div>
            <div><a href="../friends">
                <span class="material-icons-sharp">people_outline</span>
            </a></div>
            <div><a href="../create_post">
                <span class="material-icons-sharp" onclick="openBtn()">add_circle</span>
            </a></div>
            <div class="red_dot_notification"><a href="../notifications/?red=1">
                    <?php

                        // Fetch Notification Row For the Red Dot Notification
                        $redQuery = mysqli_query($con, "SELECT * FROM notifications WHERE receiver_id = '{$_SESSION['unique_id']}' AND red_dot_not = 0");
                        $dotRow = mysqli_num_rows($redQuery);
                        if($dotRow > 0){
                            // Fetch the unread notification Row Count
                            $unread_sql = mysqli_query($con, "SELECT * FROM notifications WHERE status = 0 and receiver_id = '{$_SESSION['unique_id']}'");
                            $unread_row = mysqli_num_rows($unread_sql);
                            ?>
                            <div class="red_dot_not"><span class="material-icons-sharp">circle</span><?php
                             if($unread_row > 0){
                                echo $unread_row;
                             } 
                             ?></div>
                        <?php    
                        }
                    ?>
                    <span class="material-icons-sharp">notifications</span>
                </a></div>
            <div>
                <span class="material-icons-sharp mobile-menu-open">menu</span>
            </div>                    
        </ul>
    </div>
</div>