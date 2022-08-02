<?php
    include "../includes/auth_users.php";

    // Include the Process page
    require("process_update.php");

    // Include the Image Upload Process
    require("img_upload.php");

    // Fetch the users details
    $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
    $fetch = mysqli_fetch_assoc($sql);

?>



<!-------- Include Header --------------->
<?php include "../includes/g_header.php" ?>
<body>


<!----------------Include Desktop Nav----------->
<?php include "../includes/desktop_nav.php" ?>



<!-----------Include Mobile Menu----------->
<?php include "../includes/mobile_menu.php"?>



<!-----------Include Mobile Nav Menu----------->
<?php include "../includes/nav_menu_mobile.php"?>


<!--------------------=====================User Profile Page For Mobile------------------=====================-->
<div class="user-profile-page">
    <div class="user-profile-head">
        <span class="material-icons-sharp" onclick="history.back()">west</span>
        <div>
            <h1><?php echo $fullname;?></h1>
        </div>
    </div>

    <div class="user-profile-profile-top">
        <div class="user-profile-profile-top-photo">

            <?php if($fetch['cover_photo'] != ""){
                ?>
                    <img src="cover_photos/<?php echo $fetch['cover_photo'] ?>" alt="">
            <?php
            }else{
                ?>
                    <img src="../images/cover.jpg" alt="">
            <?php
            }
            ?>
        </div>
        <div class="user-profile-profile-top-details">
            <div class="user-profile-profile-top-details-top">
                <div class="user-profile-profile-top-details-photo update">
                <?php if($fetch['profile_pic'] != ""){
                ?>      
                    <img src="profile_photos/<?php echo $fetch['profile_pic'] ?>" alt="">
                <?php
                }else{
                    ?>
                        <img src="../images/avater.jpg" alt="">
                <?php
                }
                ?>
                </div>
            </div>
            
            <div class="user-profile-profile-top-details-texts">
                <div class="user-name">
                    <h1><?php echo $fullname;?></h1>
                </div>
                <div class="user-bio">
                    <form action="" method="POST">
                        <?php 

                            if(!empty($error_msg)){
                                echo $error_msg;
                            }

                        ?>
                        <textarea id="" cols="30" name="_bio" rows="10" placeholder="<?php

                            // Check if the user has added his bio
                            if($fetch['bio'] != ""){
                                echo $fetch['bio'] . "\n";
                                echo "\r\n";
                                echo "Start typing to update. Not more that 100 letters";
                            }else{
                                echo "Tell your visitors about yourself. Not more than 100 letters";
                            }

                        ?>"></textarea>
                        <button type="submit" name="bio_update" style="background: #31A24C" class="profile-msg-btn">Update Bio</button>
                    </form>

                    <?php 

                        if(!empty($error_pic)){
                            echo $error_pic;
                        }

                    ?>

                    <form method="POST" enctype="multipart/form-data" autocomplete="off">    
                        <div style="display: flex; align-items: center; margin-bottom: 1rem">

                            <input type="file" name="profile_pic" id="profile_pic" accept="image/jpeg, image/png, image/jpg" hidden>
                            <label for="profile_pic" class="img-input" style="border-radius: 5px; margin-right: 0.5rem; padding: 0.3rem">Profile photo</label>

                            <input type="file" name="cover_photo" id="cover_pic" accept="image/jpeg, image/png, image/jpg" hidden>
                            <label for="cover_pic" class="img-input2" style="border-radius: 5px; margin-right: 0.5rem; padding: 0.3rem">Cover photo</label>

                            <input type="submit" name="submit_images" id="submit_pic" hidden>
                            <label for="submit_pic" class="img-input subInput" style="border-radius: 5px; padding: 0.3rem">Upload</label>

                        </div>
                    </form>
                    
                
                <div class="user-followers-info">
                    <div>
                    <?php 

                        if(!empty($error_msg2)){
                            echo $error_msg2;
                        }

                    ?>
                        <div class="info-flex">
                            <div class="occupation">
                                <form action="" method="POST"> 
                                    <span class="material-icons-sharp">work_outline</span>
                                    
                                    
                                    <select name="occupation" class="select" id="">

                                        <option value="">
                                        <?php
                                            // Check if the user has added his bio
                                            if($fetch['occupation'] != ""){
                                                echo $fetch['occupation'];
                                            }else{
                                                echo "Your work industry";
                                            }
                                            ?>
                                        </option>

                                        <option value="Accounting">Accounting</option>
                                        <option value="Airlines/Aviation">Airlines/Aviation</option>
                                        <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                                        <option value="Alternative Medicine">Alternative Medicine</option>
                                        <option value="Animation">Animation</option>
                                        <option value="Apparel/Fashion">Apparel/Fashion</option>
                                        <option value="Architecture/Planning">Architecture/Planning</option>
                                        <option value="Arts/Crafts">Arts/Crafts</option>
                                        <option value="Automotive">Automotive</option>
                                        <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                                        <option value="Banking/Mortgage">Banking/Mortgage</option>
                                        <option value="Biotechnology/Greentech">Biotechnology/Greentech</option>
                                        <option value="Broadcast Media">Broadcast Media</option>
                                        <option value="Building Materials">Building Materials</option>
                                        <option value="Business Supplies/Equipment">Business Supplies/Equipment</option>
                                        <option value="Capital Markets/Hedge Fund/Private Equity">Capital Markets/Hedge Fund/Private Equity</option>
                                        <option value="Chemicals">Chemicals</option>
                                        <option value="Civic/Social Organization">Civic/Social Organization</option>
                                        <option value="Civil Engineering">Civil Engineering</option>
                                        <option value="Commercial Real Estate">Commercial Real Estate</option>
                                        <option value="Computer Games">Computer Games</option>
                                        <option value="Computer Hardware">Computer Hardware</option>
                                        <option value="Computer Networking">Computer Networking</option>
                                        <option value="Computer Software/Engineering">Computer Software/Engineering</option>
                                        <option value="Computer/Network Security">Computer/Network Security</option>
                                        <option value="Construction">Construction</option>
                                        <option value="Consumer Electronics">Consumer Electronics</option>
                                        <option value="Consumer Goods">Consumer Goods</option>
                                        <option value="Consumer Services">Consumer Services</option>
                                        <option value="Cosmetics">Cosmetics</option>
                                        <option value="Dairy">Dairy</option>
                                        <option value="Defense/Space">Defense/Space</option>
                                        <option value="Design">Design</option>
                                        <option value="E-Learning">E-Learning</option>
                                        <option value="Education Management">Education Management</option>
                                        <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                                        <option value="Entertainment/Movie Production">Entertainment/Movie Production</option>
                                        <option value="Environmental Services">Environmental Services</option>
                                        <option value="Events Services">Events Services</option>
                                        <option value="Executive Office">Executive Office</option>
                                        <option value="Facilities Services">Facilities Services</option>
                                        <option value="Farming">Farming</option>
                                        <option value="Financial Services">Financial Services</option>
                                        <option value="Fine Art">Fine Art</option>
                                        <option value="Fishery">Fishery</option>
                                        <option value="Food Production">Food Production</option>
                                        <option value="Food/Beverages">Food/Beverages</option>
                                        <option value="Fundraising">Fundraising</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Gambling/Casinos">Gambling/Casinos</option>
                                        <option value="Glass/Ceramics/Concrete">Glass/Ceramics/Concrete</option>
                                        <option value="Government Administration">Government Administration</option>
                                        <option value="Government Relations">Government Relations</option>
                                        <option value="Graphic Design/Web Design">Graphic Design/Web Design</option>
                                        <option value="Health/Fitness">Health/Fitness</option>
                                        <option value="Higher Education/Acadamia">Higher Education/Acadamia</option>
                                        <option value="Hospital/Health Care">Hospital/Health Care</option>
                                        <option value="Hospitality">Hospitality</option>
                                        <option value="Human Resources/HR">Human Resources/HR</option>
                                        <option value="Import/Export">Import/Export</option>
                                        <option value="Individual/Family Services">Individual/Family Services</option>
                                        <option value="Industrial Automation">Industrial Automation</option>
                                        <option value="Information Services">Information Services</option>
                                        <option value="Information Technology/IT">Information Technology/IT</option>
                                        <option value="Insurance">Insurance</option>
                                        <option value="International Affairs">International Affairs</option>
                                        <option value="International Trade/Development">International Trade/Development</option>
                                        <option value="Internet">Internet</option>
                                        <option value="Investment Banking/Venture">Investment Banking/Venture</option>
                                        <option value="Investment Management/Hedge Fund/Private Equity">Investment Management/Hedge Fund/Private Equity</option>
                                        <option value="Judiciary">Judiciary</option>
                                        <option value="Law Enforcement">Law Enforcement</option>
                                        <option value="Law Practice/Law Firms">Law Practice/Law Firms</option>
                                        <option value="Legal Services">Legal Services</option>
                                        <option value="Legislative Office">Legislative Office</option>
                                        <option value="Leisure/Travel">Leisure/Travel</option>
                                        <option value="Library">Library</option>
                                        <option value="Logistics/Procurement">Logistics/Procurement</option>
                                        <option value="Luxury Goods/Jewelry">Luxury Goods/Jewelry</option>
                                        <option value="Machinery">Machinery</option>
                                        <option value="Management Consulting">Management Consulting</option>
                                        <option value="Maritime">Maritime</option>
                                        <option value="Market Research">Market Research</option>
                                        <option value="Marketing/Advertising/Sales">Marketing/Advertising/Sales</option>
                                        <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                                        <option value="Media Production">Media Production</option>
                                        <option value="Medical Equipment">Medical Equipment</option>
                                        <option value="Medical Practice">Medical Practice</option>
                                        <option value="Mental Health Care">Mental Health Care</option>
                                        <option value="Military Industry">Military Industry</option>
                                        <option value="Mining/Metals">Mining/Metals</option>
                                        <option value="Motion Pictures/Film">Motion Pictures/Film</option>
                                        <option value="Museums/Institutions">Museums/Institutions</option>
                                        <option value="Music">Music</option>
                                        <option value="Nanotechnology">Nanotechnology</option>
                                        <option value="Newspapers/Journalism">Newspapers/Journalism</option>
                                        <option value="Non-Profit/Volunteering">Non-Profit/Volunteering</option>
                                        <option value="Oil/Energy/Solar/Greentech">Oil/Energy/Solar/Greentech</option>
                                        <option value="Online Publishing">Online Publishing</option>
                                        <option value="Other Industry">Other Industry</option>
                                        <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                                        <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                                        <option value="Packaging/Containers">Packaging/Containers</option>
                                        <option value="Paper/Forest Products">Paper/Forest Products</option>
                                        <option value="Performing Arts">Performing Arts</option>
                                        <option value="Pharmaceuticals">Pharmaceuticals</option>
                                        <option value="Philanthropy">Philanthropy</option>
                                        <option value="Photography">Photography</option>
                                        <option value="Plastics">Plastics</option>
                                        <option value="Political Organization">Political Organization</option>
                                        <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                                        <option value="Printing">Printing</option>
                                        <option value="Professional Training">Professional Training</option>
                                        <option value="Program Development">Program Development</option>
                                        <option value="Public Relations/PR">Public Relations/PR</option>
                                        <option value="Public Safety">Public Safety</option>
                                        <option value="Publishing Industry">Publishing Industry</option>
                                        <option value="Railroad Manufacture">Railroad Manufacture</option>
                                        <option value="Ranching">Ranching</option>
                                        <option value="Real Estate/Mortgage">Real Estate/Mortgage</option>
                                        <option value="Recreational Facilities/Services">Recreational Facilities/Services</option>
                                        <option value="Religious Institutions">Religious Institutions</option>
                                        <option value="Renewables/Environment">Renewables/Environment</option>
                                        <option value="Research Industry">Research Industry</option>
                                        <option value="Restaurants">Restaurants</option>
                                        <option value="Retail Industry">Retail Industry</option>
                                        <option value="Security/Investigations">Security/Investigations</option>
                                        <option value="Semiconductors">Semiconductors</option>
                                        <option value="Shipbuilding">Shipbuilding</option>
                                        <option value="Sporting Goods">Sporting Goods</option>
                                        <option value="Sports">Sports</option>
                                        <option value="Staffing/Recruiting">Staffing/Recruiting</option>
                                        <option value="Supermarkets">Supermarkets</option>
                                        <option value="Telecommunications">Telecommunications</option>
                                        <option value="Textiles">Textiles</option>
                                        <option value="Think Tanks">Think Tanks</option>
                                        <option value="Tobacco">Tobacco</option>
                                        <option value="Translation/Localization">Translation/Localization</option>
                                        <option value="Transportation">Transportation</option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="Venture Capital/VC">Venture Capital/VC</option>
                                        <option value="Veterinary">Veterinary</option>
                                        <option value="Warehousing">Warehousing</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Wholesale">Wholesale</option>
                                        <option value="Wine/Spirits">Wine/Spirits</option>
                                        <option value="Wireless">Wireless</option>
                                        <option value="Writing/Editing">Writing/Editing</option>
                                        <button type="submit" name="work_update" class="update-btn"><span style="color: white" class="material-icons-sharp">done</span></button>
                                    
                                    </select>
                                    <button name="work_update" class="update-btn"><span style="color: white" class="material-icons-sharp">done</span></button>

                                </form>
                            </div>
                            <div class="occupation">
                                <form action="" method="POST"> 
                                    <span class="material-icons-sharp">favorite_border</span>
                                    <select name="marital_status" class="select" id="">
                                        <option value="">
                                        <?php
                                            // Check if the user has added his bio
                                            if($fetch['marital_status'] != ""){
                                                echo $fetch['marital_status'];
                                            }else{
                                                echo "Add your marital status";
                                            }

                                            ?>
                                        </option>
                                        <br>
                                        <option value="Single">Single</option>
                                        <option value="Engaged">Engaged</option>
                                        <option value="Maried">Married</option>
                                    </select>
                                    <button name="status_submit" class="update-btn"><span style="color: white" class="material-icons-sharp">done</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- End of Button for Follow or Edit Profile -->
            </div>
                <a href="../profile/?bup=<?php echo $_SESSION['unique_id']?>"><button class="profile-msg-btn" type="button">Back to Profile</button></a>
            </div>
        </div>
    </div>

</div>


<div class="mobile-profile-pic-update-modal">
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">group_add</span>
            <p>Follow</p>
        </div>
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">content_copy</span>
            <p>Copy link to profile</p>
        </div>
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">message</span>
            <p>Message</p>
        </div>
        <div class="user-profile-action-icons">
            <span class="material-icons-sharp">remove_circle_outline</span>
            <p>Block <b style="color: rgb(221, 62, 62);">Mercy..</b></p>
        </div>
        <div class="user-profile-action-icons">
            <button type="button" class="action-btn" onclick="closeProfile()">Close</button>
        </div>
    </div>

</div>


<script src="../newjs/updateprofile.js"></script>
<script src="../javascript/openProfileAction.js"></script>
<script src="../javascript/script.js"></script>
<script src="../javascript/notification.js"></script>
<script src="../javascript/darkmode.js"></script>
<script src="../javascript/darkmode2.js"></script>
<script src="../javascript/reactions.js"></script>
<script src="../javascript/mobilemenu.js"></script>
<script src="../javascript/mobile_create_post.js"></script>
</body>
</html>