<?php

    // Include the Country of the user from ipgeolocation.io
    require("../includes/geo_loc_ip.php");

    if(isset($_POST['m_f_name']) || isset($_POST['f_name'])){

        $email = "";
        $password = "";
        $error_msg = "";

        if(isset($_POST['f_name'])){
            
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $email = $_POST['email'];
            $pass_1 = $_POST['pass_1'];
            $pass_2 = $_POST['pass_2'];
        }
        elseif(isset($_POST['m_f_name'])){

            $f_name = $_POST['m_f_name'];
            $l_name = $_POST['m_l_name'];
            $email = $_POST['m_email'];
            $pass_1 = $_POST['m_pass_1'];
            $pass_2 = $_POST['m_pass_2'];
        }

        // Collect the Form Data and sanitize

        //Remove HTML ENTITIES
        $f_name = htmlentities($f_name);
        $l_name = htmlentities($l_name);
        $m_email = htmlentities($email);
        $m_pass_1 = htmlentities($pass_1);
        $m_pass_2 = htmlentities($pass_2);

        //Remove Slashes
        $f_name = stripslashes($f_name);
        $l_name = stripslashes($l_name);
        $m_email = stripslashes($m_email);
        $m_pass_1 = stripslashes($m_pass_1);

        //Escape Strings
        $f_name = mysqli_real_escape_string($con, $f_name);
        $l_name = mysqli_real_escape_string($con, $l_name);
        $m_email = mysqli_real_escape_string($con, $m_email);
        $m_pass_1 = mysqli_real_escape_string($con, $m_pass_1);


        // Unique ID generation
        $user_id = rand(100, 10000000);
        $time = time();
        $user_id = $user_id.$time;
        $unique_id = md5($user_id);


        // Verification Code Generator
        $v_code = md5(time().$m_email);



        // Check if all inputs where filled
        if(!empty($f_name) && !empty($l_name) && !empty($m_email) && !empty($m_pass_1) && !empty($pass_2)){

            // Check if Password 1 is equal to Password 2
            if($m_pass_1 == $pass_2){

                $pass_len = strlen("$m_pass_1");

                // Check if Password Lenght is greater than 5
                if(strlen($pass_len > 5)){

                    //Hash the Password
                    $m_pass_1 = md5($m_pass_1);

                    // Check if valid email data was entered
                    if(filter_var($m_email, FILTER_VALIDATE_EMAIL)){

                        // Check if Email does not exist in the Database
                        $select_sql = mysqli_query($con, "SELECT * FROM users WHERE email = '$m_email'");

                    if(mysqli_num_rows($select_sql) > 0){
                        $error_msg = "$m_email is already in use!";
                    }else{
                        // Insert data into the users table in the database
                        $insert_sql = mysqli_query($con, "INSERT INTO users (`unique_id`, `f_name`, `l_name`, `email`, `password`, `v_code`, `location`) 
                        VALUES ('{$unique_id}', '{$f_name}', '{$l_name}', '{$m_email}', '{$m_pass_1}', '{$v_code}', '{$fetch->country_name}')");

                        if($insert_sql){
                            
                            // Send a verification code to the user
                            $mail_to = $m_email;
                            $mail_subject = "BaE Email Verification";
                            $mail_message = "Thanks for Registering. Click on this <a href='https://mybaenetworks.com/authentications/verify.php?v_code=$v_code&mail=$m_email'>link</a> to verify your account";
                            $headers = "From: mybae@mybaenetworks.com \r\n";
                            $headers .= "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                            // Send mail
                            mail($mail_to,$mail_subject,$mail_message,$headers);

                            // Start a Session that will Help Fetch the user Email on the Thank you page
                            session_start();
                            $_SESSION['reg_email'] = $m_email;
                            
                            header("location:  thankyou.php");

                        }else{
                            $error_msg = "Something went wrong!";
                        }
                    }

                    }else{
                        $error_msg = "$m_email is not a valid Email!";
                    }

                }else{
                    $error_msg = "Password must be more than 5";
                }

            }else{
                $error_msg = "Passwords do not match";
            }

        }else{
            $error_msg = "All input fields are required!";
        }

        



    }

?>