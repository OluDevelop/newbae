<?php
    // Start a Session
    session_start(); 
    include "config_tdb.php";
?>

<?php include "../includes/g_header.php" ?>

<?php

    if(!isset($_SESSION['reg_email'])){
        header("location: register.php");
    }else{
        $reg_email = $_SESSION['reg_email'];
    }

    // Resend Verification Link
    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$reg_email'");

    if(mysqli_num_rows($sql) == 1 && $fetch = mysqli_fetch_assoc($sql)){
        $v_code = $fetch['v_code'];
    }

?>

<body style="background: #FFFFF">

<div class="registration-wrapper">
    
    <div class="registration-form">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1 style="color: #555">BaE</h1>
    </div>

        <div class="registration-form-head">
            <h1>Kindly verify your account now</h1>
        </div>

        <div class="thank-you" style="margin-top: 1rem">
        <p>We've sent a verification link to <b><?php echo $reg_email;?></b> <br> Click on the button below to go to your Mail.</p>
        <form action="resend_link.php?brm=<?php echo $reg_email;?>&v_code=<?php echo $v_code;?>" method="POST">
            <p>Resend link? / <input type="submit" style="width: 4rem; cursor: pointer; height: 1.5rem; font-size: 1rem; background: transparent; border: none; color: #721c24;" name="resend" class="resend_btn" value="resend"></p>
        </form>        
        <a href="https://gmail.com"><button name="submit_btn" class="auth-btn"> <span class="material-icons-sharp">mail</span> Email</button></a>
  
    </div>
        
    </div>

</div>


<div class="registration-wrapper-mobile">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1>BaE</h1>
    </div>

    <div class="registration-form-head-mobile">
        <h1>Verify <br>Your Account</h1>
        <form action="resend_link.php?brm=<?php echo $reg_email;?>&v_code=<?php echo $v_code;?>" method="POST">
            <div class="resend">
                <p>Resend link? / <input type="submit" style="width: 5rem; height: 1.5rem; background: transparent; color: #721c24;" name="resend" class="resend_btn" value="resend"></p>
            </div>
        </form>
    </div>
    


    <div class="thank-you">
        <p>We've sent a verification link to <b><?php echo $reg_email;?></b> Click on the button below to go to your Mail.</p>

        <br>
        <a href="https://gmail.com"><button class="auth-btn"> <span class="material-icons-sharp">mail</span></button></a>
    </div>


</div>




</body>
</html>


</body>
</html>