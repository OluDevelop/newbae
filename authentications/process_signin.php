<?php
    session_start();
    // Sign in system for both mobile and desktop forms m_email (email coming from mobile) email (email coming from desktop)

    // Check if the user is submiting on desktop or mobile
    if(isset($_POST['m_email']) || isset($_POST['email'])){

        $email = "";
        $password = "";
        $error_msg = "";

        if(isset($_POST['email'])){
            
            $email = $_POST['email'];
            $password = $_POST['pass'];
        }
        elseif(isset($_POST['m_email'])){

            $email = $_POST['m_email'];
            $password = $_POST['m_pass'];
        }

        // Check if none of the Fields are empty
        if(!empty($email) && !empty($password)){

            // SANITIZE THE SUBMITTED FORM DATA

            // Remove HTML ENTITIES
            $email = htmlentities($email);
            $password = htmlentities($password);

            // Remove Slashes
            $email = stripslashes($email);
            $password = stripslashes($password);

            // Escape Strings
            $email = mysqli_real_escape_string($con, $email);
            $password = mysqli_real_escape_string($con, $password);


            // Hash the Password
            $password = md5($password);

            // Check if this Email exist in the Database
            $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");

            if(mysqli_num_rows($sql) > 0){

                // Check if the Password is Correct
                $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

                if(mysqli_num_rows($sql) == '1'){

                    // Check if the Account has been verified
                    $status = mysqli_fetch_assoc($sql);
                    if($status['verified'] == 1){

                        // Fetch the User's Data ['unique_id']
                        $fetch_id = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");

                        if($fetch = mysqli_fetch_assoc($fetch_id)){

                            $unique_id = $fetch['unique_id'];
                            
                            // Create Session and Log the User into the Home Page
                            $_SESSION['unique_id'] = $unique_id;
                            
                            // Update user's online_status
                            $sql = mysqli_query($con, "UPDATE users SET online_status = 'online' WHERE unique_id =  '$unique_id'");
    
                            header("location: ../");

                        }else{
                            $error_msg = "Failed to Fetch";
                        }
                    
                    }else{
                        
                        $_SESSION['reg_email'] = $email;
                        header("Location: thankyou.php");
                        
                    }

                }else{
                    $error_msg = "Incorrect Password!";
                }

            }else{
                $error_msg = "This email does not exist!";
            }

        
        }else{
            $error_msg = "All fields are required!";
        }

    }


?>