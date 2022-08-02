<?php

    include "config_tdb.php";
    include "process_the_reg.php";

?>

<?php include "../includes/g_header.php" ?>
<body style="background: #ffffff">


<div class="registration-wrapper">

    <div class="registration-form">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1 style="color: #555">BaE</h1>
    </div>

        <div class="registration-form-head">
            <h1>Kindly sign up with your Email now</h1>
            <p>Already have an account? <a href="../authentications"><span>Sign in</span></a></p>
        </div>

        <!---- Check if there is an Error while Registering, if yes, send an Error Message-->
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


        <form method="POST">

            <div class="input-field">
                <input type="text" name="f_name" placeholder="First name">
            </div>
            
            <div class="input-field">
                <input type="text" name="l_name" placeholder="Last name">
            </div>

            <div class="input-field">
                <input type="email" name="email" placeholder="Email">
            </div>

            <div class="input-field">
                <input type="password" name="pass_1" placeholder="Password">
            </div>

            <div class="input-field">
                <input type="password" name="pass_2" placeholder="Confirm password">
            </div>

            <button type="submit" name="submit_btn" class="auth-btn">Create account</button>
        </form>
    </div>

</div>


<div class="registration-wrapper-mobile">

    <div class="logo">
        <!-- <img src="../images/newBaeLogo.png" alt=""> -->
        <h1>BaE</h1>
    </div>

    <div class="registration-form-head-mobile">
        <h1>Welcome <br> Create New.</h1>
        <p>Not new? <a href="../authentications"><span style="color: #b22341;">Sign in</span></a></p>
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

    <!---- Send Success message to user for email verification ----->
    <?php
        if(!empty($success_msg)){
            ?>
            <div class="success-msg">
                <?php 
                    echo $success_msg;
                ?>
            </div>
        <?php
        }
    ?>


    <form method="POST">

        <div class="input-field">
            <input type="text" value="<?php if(isset($f_name)){echo $f_name;} ?>" name="m_f_name" placeholder="First name" autocomplete="off">
        </div>
        
        <div class="input-field">
            <input type="text" value="<?php if(isset($l_name)){echo $l_name;} ?>" name="m_l_name" placeholder="Last name" autocomplete="off">
        </div>

        <div class="input-field">
            <input type="email" value="<?php if(isset($m_email)){echo $m_email;} ?>" name="m_email" class="coloredd" placeholder="Email" autocomplete="off">
        </div>

        <div class="input-field">
            <input type="password" name="m_pass_1" placeholder="Password" autocomplete="off">
        </div>
        <div class="input-field">
            <input type="password" name="m_pass_2" placeholder="Confirm password" autocomplete="off">
        </div>

        <button type="submit" name="m_submit" class="auth-btn">Create account</button>


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