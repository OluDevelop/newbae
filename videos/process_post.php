<?php
  include "../authentications/config_tdb.php";

  $user_id = $_SESSION['unique_id'];

  if(isset($_POST['privacy'])){

    // Collect Post Datails
    $privacy = mysqli_real_escape_string($con, $_POST['privacy']);
    $text = mysqli_real_escape_string($con, $_POST['post_text']);
    $text = htmlentities($text);
    $text = stripslashes($text);
  
   
    // Post id generator
    $sec = time();
    $randn = rand(200, 900000);
    $post_id = $sec . $randn;


    if(isset($_FILES['image_capture']) || isset($_FILES['gallery_images'])){

      if(!empty($_FILES['image_capture']['name'])){

      $img_name = $_FILES['image_capture']['name'];
      $img_type = $_FILES['image_capture']['type'];
      $img_tmp = $_FILES['image_capture']['tmp_name'];


      // Create random characters for new image name
      $time = time();
      $rand = rand(99, 999999);
      $new_img_name = $time.$rand.$img_name;


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

        //Time Post was posted
        date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
        $period = date("Y-m-d h:i:sa");



        $explode_cover_photos = explode(".", $img_name);
        
        if(end($explode_cover_photos) == "png"){
          imagejpeg(imagecreatefrompng($img_tmp), $img_tmp, 20);
          move_uploaded_file($img_tmp, "images/". $new_img_name);

        }elseif(end($explode_cover_photos) == "gif"){
          $error_pic = "Invalid image format";

        }else{
          correctImageOrientation($img_tmp);
          imagejpeg(imagecreatefromjpeg($img_tmp), $img_tmp, 20);
          move_uploaded_file($img_tmp, "images/". $new_img_name);

        }

        // correctImageOrientation($img_tmp);
        // move_uploaded_file($img_tmp, "images/". $new_img_name);


        // Insert Post into the database
        $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_img, post_privacy, post_id, timeposted) VALUES ('$user_id', '$text', '$new_img_name', '$privacy', '$post_id', '$period')");

        // Redirect user back to home page
        header("Location: ../");
      }else{
        
        if(!empty($_FILES['gallery_images']['name'])){
          $img_name = $_FILES['gallery_images']['name'];
          $img_type = $_FILES['gallery_images']['type'];
          $img_tmp = $_FILES['gallery_images']['tmp_name'];
    
    
          // Create random characters for new image name
          $time = time();
          $rand = rand(99, 999999);
          $new_img_name = $time.$rand.$img_name;
    
    
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
    
          //Time Post was posted
          date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
          $period = date("Y-m-d h:i:sa");
    
    
          $explode_cover_photos = explode(".", $img_name);

          if(end($explode_cover_photos) == "png"){
              imagejpeg(imagecreatefrompng($img_tmp), $img_tmp, 20);
              move_uploaded_file($img_tmp, "images/". $new_img_name);

          }elseif(end($explode_cover_photos) == "gif"){
              $error_pic = "Invalid image format";

          }else{
              correctImageOrientation($img_tmp);
              imagejpeg(imagecreatefromjpeg($img_tmp), $img_tmp, 20);
              move_uploaded_file($img_tmp, "images/". $new_img_name);
          }
    
          // correctImageOrientation($img_tmp);
          // move_uploaded_file($img_tmp, "images/". $new_img_name);
    
    
          // Insert Post into the database
          $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_img, post_privacy, post_id, timeposted) VALUES ('$user_id', '$text', '$new_img_name', '$privacy', '$post_id', '$period')");
    
          // Redirect user back to home page
          header("Location: ../"); 
        }else{
          // Insert Post into the database

          //Time Post was posted
          date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
          $period = date("Y-m-d h:i:sa");

          $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_privacy, post_id, timeposted) VALUES ('$user_id', '$text', '$privacy', '$post_id', '$period')");
          header("location: ../");
        }

      }

    }else{
      // Insert Post into the database

        //Time Post was posted
        date_default_timezone_set('Africa/Lagos'); //Sets the System Default time to Africa/Lagos
        $period = date("Y-m-d h:i:sa");
        if($text != ''){
          $sql = mysqli_query($con, "INSERT INTO posts (unique_id, post_text, post_privacy, post_id, timeposted) VALUES ('$user_id', '$text', '$privacy', '$post_id', '$period')");
          header("location: ../");
        }else{
          header("location: ../");
        }
        
    }
  }


  if(isset($_POST['desktop_privacy'])){
    echo "Set";
}


?>