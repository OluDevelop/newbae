<?php include "../includes/g_header.php" ?>
<?php include "config_tdb.php" ?>


<body style="background: #FFFFF">

<?php

    if($_REQUEST['v_code'] && $_REQUEST['mail']){
        $v_code = $_REQUEST['v_code'];
        $checkEmail = $_REQUEST['mail'];
        
        // Update verified
        $sql = mysqli_query($con, "UPDATE users SET `verified` = 1 WHERE `v_code` = '$v_code' AND `email` = '$checkEmail'");

        if($sql){
        
        ?>
            <div class="registration-wrapper">
    
                <div class="registration-form">
                    <div class="registration-form-head">
                        <h1>Email verification was successful</h1>
                    </div>

                    <div class="thank-you">
                        <p>Your email has been successfully verified. Click on the button below to login</p>

                        <br>
                        <a href="index.php"><button style="background: #38aa68" class="auth-btn">Login now</span></button></a>
                    </div>
                    
                </div>

            </div>

            <div class="registration-wrapper-mobile">

                <div class="logo">
                    <!-- <img src="../images/newBaeLogo.png" alt=""> -->
                    <h1>BaE</h1>
                </div>

                <div class="registration-form-head-mobile">
                    <h1>Verification<br>Successful</h1>
                </div>


                <div class="thank-you">
                    <p>Your email has been successfully verified. Click on the button below to login</p>

                    <br>
                    <a href="index.php"><button style="background: #38aa68" class="auth-btn">Login now</span></button></a>
                </div>


            </div>

        <?php
        }else{
            echo "Failed to Verify";
        }

    }else{
        header("location: register.php");
    }

?>

</body>
</html>