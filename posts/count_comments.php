<?php

   require("../authentications/config_tdb.php");
   $post_id = $_POST['post_id'];

   // Fetch the comments on the post
   $sql = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '$post_id' AND comment != ''");
   $count = mysqli_num_rows($sql);

   if($count > 0){
       echo $count;
   }else{
       echo 0;
   }

   


?>