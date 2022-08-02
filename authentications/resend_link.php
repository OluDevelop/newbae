<?php

    if(isset($_REQUEST['brm'])){
        
        $m_email = $_REQUEST['brm'];
        $v_code = $_REQUEST['v_code'];

        // Send a verification code to the user
        $mail_to = $m_email;
        $mail_subject = "BaE Email Verification";
        $mail_message = "Thanks for Registering. Click on this <a href='https://mybaenetworks-com.us.stackstaging.com/authentications/verify.php?v_code=$v_code&mail=$m_email'>link</a> to verify your account";
        $headers = "From: smtp.stackmail.com \r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // Send mail
        mail($mail_to,$mail_subject,$mail_message,$headers);

        
        session_start();
        $_SESSION['link_resent'] = "sent";
        header("location: confirm_sent.php");

    }else{
        header("Location: register.php");
    }


?>