<?php

// Connecting to the Database

$host = "localhost";
$user = "root";
$pass = "";
$name = "baemedia";

// $host = "50.87.143.111";
// $user = "mybaenet_Baeadmin";
// $pass = "Baeadmin12345*";
// $name = "mybaenet_Baedb";


if(!$con = mysqli_connect($host,$user,$pass,$name)){
    die("Failed to connect to db");
}


?>