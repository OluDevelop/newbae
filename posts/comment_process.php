<?php

include "../authentications/config_tdb.php";

    if(isset($_POST['comment'])){
        
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $post_id = $_POST['post_id'];

        // Insert Comment into the post reaction table
        $sql = mysqli_query($con, "INSERT INTO post_reactions (comment, unique_id, post_id) values ('$comment', '{$_SESSION['unique_id']}', '$post_id')");

        header("location: ../posts?mbpc=$post_id");
        

    }


?>