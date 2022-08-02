<?php
    
    session_start();
    require("../authentications/config_tdb.php");

    $unique_id = $_SESSION['unique_id'];
    $post_id = $_POST["post_id"];

     // Fetch post Reactions
    $reaction_query = mysqli_query($con, "SELECT * FROM post_reactions WHERE post_id = '$post_id' AND comment != ''");

    if(mysqli_num_rows($reaction_query) != 0){
        while($fetch_reactions = mysqli_fetch_assoc($reaction_query)){

            // Fetch engagers details
            $sql_engage = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$fetch_reactions['unique_id']}'");
            $user_details = mysqli_fetch_assoc($sql_engage);
            $fullname2 = $user_details['f_name'] . ' ' . $user_details['l_name'];
   
           $result_output = require("comment_data.php");
       }
    }

    

?>



