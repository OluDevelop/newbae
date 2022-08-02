<?php
    require("authentications/config_tdb.php");
    $user_id = $_SESSION['unique_id'];


    if(isset($_POST['desktop_privacy'])){
        
        $text = mysqli_real_escape_string($con, $_POST['text_desktop']);
        $privacy = $_POST['desktop_privacy'];

        // Post id generator
        $sec = time();
        $randn = rand(200, 900000);
        $post_id = $sec . $randn . time();
        
        if(!empty($_FILES['gallery_images_desk']['name'])){
            
            $img_name = $_FILES['gallery_images_desk']['name'];
            $img_type = $_FILES['gallery_images_desk']['type'];
            $img_tmp = $_FILES['gallery_images_desk']['tmp_name'];

            // Create random characters for new image name
            $time = time();
            $rand = rand(99, 9949929);
            $new_img_name = $time.$rand.$img_name;

            // Prevent Image Auto Rotation
            function correctImageOrientation($filename) {
                if(function_exists('exif_read_data')) {
                    $exif = exif_read_data($filename);
                    if($exif && isset($exif['Orientation'])) {
                        $orientation = $exif['Orientation'];
                        if($orientation != 1){
                        $img = imagecreatefromjpeg($filename);
                        $deg = 0;
                        switch ($orientation) {
                            case 3:
                            $deg = 180;
                            break;
                            case 6:
                            $deg = 270;
                            break;
                            case 8:
                            $deg = 90;
                            break;
                        }
                        if ($deg) {
                            $img = imagerotate($img, $deg, 0);        
                        }
                        // then rewrite the rotated image back to the disk as $filename 
                        imagejpeg($img, $filename, 40);
                        } // if there is some rotation necessary
                    } // if have the exif orientation info
                } // if function exists      
            }

            //Time Post was posted
            date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
            $period = date("Y-m-d h:i:sa");

            $explode_cover_photos = explode(".", $img_name);
            if(end($explode_cover_photos) == "png"){
                imagejpeg(imagecreatefrompng($img_tmp), $img_tmp, 40);
                move_uploaded_file($img_tmp, "create_post/images/". $new_img_name);
            }elseif(end($explode_cover_photos) == "gif"){
                $error_pic = "Invalid image format";
            }else{
                correctImageOrientation($img_tmp);
                move_uploaded_file($img_tmp, "create_post/images/". $new_img_name);
            }
    
            // correctImageOrientation($img_tmp);
            // move_uploaded_file($img_tmp, "images/". $new_img_name);
        
        
            // Insert Post into the database
            $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_img, post_privacy, post_id, timeposted) 
                VALUES ('$user_id', '$text', '$new_img_name', '$privacy', '$post_id', '$period')");
        
            // Redirect user back to home page
            header("Location: ../baechat");


        }elseif(!empty($_FILES['gallery_videos_desk']['name'])){

            $vidName = $_FILES['gallery_videos_desk']['name'];
            $vidTmp = $_FILES['gallery_videos_desk']['tmp_name'];
            $vidType = $_FILES['gallery_videos_desk']['type'];

            // Generate Random Video name
            $time = time();
            $rand = rand(99, 9949929);
            $vidNewName = $time.$rand.$vidName;

            move_uploaded_file($vidTmp, "create_post/videos/". $vidNewName);

            //Time Post was posted
            date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
            $period = date("Y-m-d h:i:sa");

            $sqlVid = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_vid, post_privacy, post_id, timeposted) 
                VALUES ('$user_id', '$text', '$vidNewName', '$privacy', '$post_id', '$period')");

            // Redirect user back to home page
            header("Location: ../baechat");

        }else{
            // Insert Post into the database
  
            //Time Post was posted
            date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
            $period = date("Y-m-d h:i:sa");
  
            $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_privacy, post_id, timeposted) VALUES ('$user_id', '$text', '$privacy', '$post_id', '$period')");
            header("location: ../baechat");
        }
        
    }


?>