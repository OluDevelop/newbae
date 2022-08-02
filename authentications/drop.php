    <?php

        session_start();
        include "config_tdb.php";
        include "process_the_signin.php";

    ?>

    <?php include "../includes/g_header.php" ?>

    <body style="background: #ffffff">


<!------------------------------------Sign in page for desktop------------------------------------>
    <div class="registration-wrapper">
        
        <div class="registration-form">
            <div class="registration-form-head">
                <h1>Sign in with your phone number</h1>
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


            <form method="POST">

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div class="input-field">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button type="submit" name="submit_btn" class="auth-btn">Create account</button>
            </form>
        </div>

    </div>



<!------------------------------------Sign in page for Mobile------------------------------------>
    <div class="registration-wrapper-mobile">

        <div class="logo">
            <!-- <img src="../images/newBaeLogo.png" alt=""> -->
            <h1>BaE</h1>
        </div>

        <div class="registration-form-head-mobile">
            <h1>Hey, <br>Login Now.</h1>
            <p>If you are new / <a href="register.php"><span style="color: #b22341;">Create New</span></a></p>
        </div>

        <!------------- Check if there is an Error while Signing in, if yes, send an Error Message ----------->
        <?php  
            if(!empty($error_msg)){
                ?>
                <div class="error-msg-mobile">
                    <?php 
                        echo $error_msg;
                    ?>
                </div>
            <?php
            }
        ?>
                    
        <form method="POST" autocomplete="off">

            <div class="input-field">
                <input type="email" class="colored" name="m_email" placeholder="Email" autocomplete="off">
            </div>

            <div class="input-field">
                <input type="password" name="m_password" placeholder="Password" autocomplete="off">
                <div class="registration-form-head-mobile">
                    <p>Forgot Password? / <a href="../authentications/"><span style="color: #b22341;">Reset</span></a></p>
                </div>
            </div>
            
            <button type="submit" name="m_submit_btn" class="auth-btn">Sign in</button>


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