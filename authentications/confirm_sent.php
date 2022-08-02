<?php
    // Start a Session
    session_start(); 
    include "config_tdb.php";
?>

<?php include "../includes/g_header.php" ?>

<?php

    if(!isset($_SESSION['link_resent'])){
        header("location: register.php");
    }

?>

<body style="background: #FFFFF">

<div class="registration-form">

<div class="logo">
    <!-- <img src="../images/newBaeLogo.png" alt=""> -->
    <h1>BaE</h1>
</div>

    <div class="registration-form-head">
        <h1>Verification link sent</h1>
    </div>

    <div class="thank-you" style="margin-top: 1rem">
    <p>We've sent a verification link to the email you provided. <br> Kindly login to the mail to verify.</p>        
    <a href="https://gmail.com"><button class="auth-btn"> <span class="material-icons-sharp">mail</span>Email</button></a>

</div>
    
</div>

</div>


<div class="registration-wrapper-mobile">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1>BaE</h1>
    </div>

    <div class="registration-form-head-mobile">
        <h1>Verification <br>Link sent</h1>
        <form action="resend_link.php?brm=<?php echo $reg_email;?>&v_code=<?php echo $v_code;?>" method="POST">
            <div class="resend">
                <p>Please Check your Email</p>
            </div>
        </form>
    </div>


    <div class="thank-you">
        <p>A verification link has been resent to your Email, kindly check your inbox or spam for the link.</p>

        <br>
        <a href="https://gmail.com"><button class="auth-btn"> <span class="material-icons-sharp">mail</span></button></a>
    </div>


</div>




</body>
</html>


</body>
</html>