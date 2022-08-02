<?php


require("../authentications/config_tdb.php");
session_start();

$session_id = $_SESSION['unique_id'];
$post_id = $_POST['post_id'];


// Remove user like if this user is already following
$sql1 = mysqli_query($con, "SELECT * FROM post_reactions WHERE love = 'love' AND unique_id = '$session_id'");

$row = mysqli_num_rows($sql1);

if($row > 0){
    echo "true";
}else{
    echo "false";
}


?>