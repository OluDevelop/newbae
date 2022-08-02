<?php

    include "../authentications/config_tdb.php";

    // Fetch the Post Details
    $post_id = $_POST['id'];
    $sql = mysqli_query($con, "SELECT * FROM posts WHERE post_id = '$post_id'");

    $time = mysqli_fetch_assoc($sql);
    $timeposted = $time['timeposted'];

    $timeposted = strtotime($timeposted);
    $currentTime = strtotime(date("Y-m-d h:i:sa"));

    $time_difference = $currentTime - $timeposted;

    echo "new post disappears after 60sec";

?>