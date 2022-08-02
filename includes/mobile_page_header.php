
<?php

    // Includes 
    include "../authentications/config_tdb.php";

    // Fetch the users details
    $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
    $user_data = mysqli_fetch_assoc($sql);

?>

<!------------------------------For Mobile Page Header------------------------------>
<div class="mobile-page-header">
    <div class="mobile-page-header-img">
    <a href="../profile/?bup=<?php echo $_SESSION['unique_id']?>&upd=0">
    
    <?php if($user_data['profile_pic'] != ""){
        ?>      
            <img src="../profile/profile_photos/<?php echo $user_data['profile_pic'] ?>" alt="">
        <?php
        }else{
            ?>
            <img src="../images/avater.jpg" alt="">
        <?php
        }
    ?>
    </div>
    <div class="mobile-page-header-search">
        <span class="material-icons-sharp">search</span>
        <input type="search" class="focusOnSearch" placeholder="Looking for a friend?">
    </div>
    <a href="../messenger"><span class="material-icons-sharp">question_answer</span></a>
</div>