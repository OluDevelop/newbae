<?php

   // Profile Images Update
    if(isset($_POST['submit_images'])){
       

        // Check if both Profile Pic and Cover Photo are not empty

        if(!empty($_FILES['profile_pic']['name'] || !empty($_FILES['cover_photo']['name']))){


            //Check if the Profile Pic is set
            if(isset($_FILES['profile_pic'])){
                
                if(!empty($_FILES['profile_pic']['name'])){

                    $file_name = $_FILES['profile_pic']['name'];
                    $file_type = $_FILES['profile_pic']['type'];
                    $tmp_loc = $_FILES['profile_pic']['tmp_name'];


                    // Create random characters for new image name
                    $time = time();
                    $rand = rand(99, 999999);
                    $new_img_name = $time.$rand.$file_name;
                    
                    // Prevent Image Auto Rotation
                    function correctImageOrientation($filename) {
                        if (function_exists('exif_read_data')) {
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


                    $explode_cover_photos = explode(".",$file_name);

                    if(end($explode_cover_photos) == "png"){
                        imagejpeg(imagecreatefrompng($tmp_loc), $tmp_loc, 30);
                        move_uploaded_file($tmp_loc, "profile_photos/". $new_img_name);

                    }elseif(end($explode_cover_photos) == "gif"){
                        $error_pic = "Invalid image format";
                    }else{
                        correctImageOrientation($tmp_loc);
                        imagejpeg(imagecreatefromjpeg($tmp_loc), $tmp_loc, 30);
                        move_uploaded_file($tmp_loc, "profile_photos/". $new_img_name);

                    }

                    // Insert file newname into the database
                    $sql = mysqli_query($con, "UPDATE users SET profile_pic = '$new_img_name' WHERE unique_id = '{$_SESSION['unique_id']}'");

                }

            }

            // Check if Cover Photo is Set
            if(isset($_FILES['cover_photo'])){
                
                if(!empty($_FILES['cover_photo']['name'])){

                    $file_name = $_FILES['cover_photo']['name'];
                    $file_type = $_FILES['cover_photo']['type'];
                    $tmp_loc = $_FILES['cover_photo']['tmp_name'];


                    // Create random characters for new image name
                    $time = time();
                    $rand = rand(99, 999999);
                    $new_img_name = $time.$rand.$file_name;
                    
                    // Prevent Image Auto Rotation
                    function correctImageOrientation($filename) {
                        if (function_exists('exif_read_data')) {
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


                    
                    $explode_cover_photos = explode(".",$file_name);

                    if(end($explode_cover_photos) == "png"){
                        imagejpeg(imagecreatefrompng($tmp_loc), $tmp_loc, 30);
                        move_uploaded_file($tmp_loc, "cover_photos/". $new_img_name);

                    }elseif(end($explode_cover_photos) == "gif"){
                        $error_pic = "Invalid image format";
                    }else{
                        correctImageOrientation($tmp_loc);
                        imagejpeg(imagecreatefromjpeg($tmp_loc), $tmp_loc, 30);
                        move_uploaded_file($tmp_loc, "cover_photos/". $new_img_name);

                    }

                    // Insert file newname into the database
                    $sql = mysqli_query($con, "UPDATE users SET cover_photo = '$new_img_name' WHERE unique_id = '{$_SESSION['unique_id']}'");
                }

            }


        }else{
            $error_pic = '<small style="color: red;">Please select a file for upload</small>';
        }


    }



?>

