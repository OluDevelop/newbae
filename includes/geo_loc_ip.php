<?php

    $ip = $_SERVER['REMOTE_ADDR'];

    // Following code returns the curl output as a string.

    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.ipgeolocation.io/ipgeo?apiKey=e5ffba83a862459595c96b446790c240&ip=".$ip."&fields=country_name");

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);   
    
    $fetch = json_decode($output);

?>