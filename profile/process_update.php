<?php


    if(isset($_SESSION['unique_id'])){

        if(isset($_POST['bio_update'])){
            
            // Check if the bio field is not empty
            if(!empty($_POST['_bio'])){

                $bio = htmlentities($_POST['_bio']);
                $bio = mysqli_real_escape_string($con, $bio);
                $bio = stripslashes($bio);


                // Check if the Bio letter is not more than 100
                if(strlen($bio) > 100){
                    $error_msg = '<small style="color: red;">Your Bio must not be more than 100 letters</small>';
                }else{

                    // Insert the bio into the user table
                    $sql = mysqli_query($con, "UPDATE users SET bio = '$bio' WHERE unique_id = '{$_SESSION['unique_id']}'");

                }


            }else{
                $error_msg = "You did not enter your bio";
            }
        }


        // For Work
        if(isset($_POST['work_update'])){
            
            if(!empty($_POST['occupation'])){
                $occupation = htmlentities($_POST['occupation']);
                $occupation = mysqli_real_escape_string($con, $occupation);
                $occupation = stripslashes($occupation);

                // Insert the bio into the user table
                $sql = mysqli_query($con, "UPDATE users SET occupation = '$occupation' WHERE unique_id = '{$_SESSION['unique_id']}'");

            }else{
                $error_msg2 = '<small style="color: red;">You\'ve submitted an empty field</small>';
            }
        }


        //  For Location
        if(isset($_POST['loc_submit'])){
            
            if(!empty($_POST['location'])){
                $location = htmlentities($_POST['location']);
                $location = mysqli_real_escape_string($con, $location);
                $location = stripslashes($location);

                // Insert the bio into the user table
                $sql = mysqli_query($con, "UPDATE users SET location = '$location' WHERE unique_id = '{$_SESSION['unique_id']}'");

            }else{
                $error_msg2 = '<small style="color: red;">You\'ve submitted an empty field</small>';
            }
        }

        //  For Marital Status
        if(isset($_POST['status_submit'])){
            
            if(!empty($_POST['marital_status'])){
                $marital_status = htmlentities($_POST['marital_status']);
                $marital_status = mysqli_real_escape_string($con, $marital_status);
                $marital_status = stripslashes($marital_status);

                // Insert the bio into the user table
                $sql = mysqli_query($con, "UPDATE users SET marital_status = '$marital_status' WHERE unique_id = '{$_SESSION['unique_id']}'");

            }else{
                $error_msg2 = '<small style="color: red;">You\'ve submitted an empty field</small>';
            }
        }


    }else{
        header("location: ../");
    }

?>