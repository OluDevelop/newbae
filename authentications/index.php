<?php

    include "config_tdb.php";
    include "process_signin.php";

?>

<?php include "../includes/g_header.php" ?>
<body style="background: #ffffff">

<!------------------------------------Sign in page for desktop------------------------------------>
<div class="registration-wrapper">

        <div class="registration-form">

        <div class="logo">
            <!-- <img src="../images/newBaeLogo.png" alt=""> -->
            <h1 style="color: #555">BaE</h1>
        </div>

            <div class="registration-form-head">
                <h1>Welcome - Sign in with your Email</h1>
                <p>Don't have an account yet?<a href="register.php"> <span>Sign up</span></a></p>
            </div>
            
            <!------------- Check if there is an Error while Signing in, if yes, send an Error Message ----------->
            <?php  
                if(!empty($error_msg)){
                    ?>
                    <div class="error-msg">
                        <?php 
                            echo $error_msg;
                        ?>
                    </div>
                <?php
                }
                
            ?>


            <form method="POST" autocomplete="off">

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div class="input-field">
                    <input type="password" name="pass" placeholder="Password">
                </div>

                <button type="submit" name="submit_btn" class="auth-btn">Login</button>
            </form>

        </div>

</div>


<div class="registration-wrapper-mobile">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1>BaE</h1>
    </div>

    <div class="registration-form-head-mobile">
        <h1>Hey, <br>Login Now.</h1>
        <p>If you are new / <a href="register.php"><span style="color: #b22341;">Create Account</span></a></p>
    </div>

    <!---- Check if there is an Error while Registering on mobile, if yes, send an Error Message-->
        <?php  
            if(!empty($error_msg)){
                ?>
                <div class="error-msg">
                    <?php 
                        echo $error_msg;
                    ?>
                </div>
            <?php
            }
        ?>


    <form method="POST" autocomplete="off">

        <div class="input-field">
            <input type="email" name="m_email" value="<?php if(isset($m_email)){echo $m_email;} ?>" class="coloredd" placeholder="Email" autocomplete="off">
        </div>

        <div class="input-field">
            <input type="password" name="m_pass" placeholder="Password" autocomplete="off">
        </div>

        <button type="submit" name="m_submit" class="auth-btn">Login</button>


        <div class="powered-by">
            <?php
                // Current year
                $year = date("Y");
                echo "<p>BaE © " . $year . "</p>";

            ?>
            </div>

    </form>

</div>



<!-----------------------Dark and Light Mode Actication----------------------->
<div id="dark-btn" style="display: none;">
    <span></span>
</div>
<div id="dark-btn2" style="display: none;">
    <span></span>
</div>

<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
</body>
</html>
