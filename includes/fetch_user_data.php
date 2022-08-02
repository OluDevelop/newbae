<?php




   if(isset($_SESSION['unique_id'])){

        $id = $_SESSION['unique_id'];

        // Fetch Data From Database
        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `unique_id` = '$id'");

        if($sql){

            $user_data = mysqli_fetch_assoc($sql);

        }

   }


?>