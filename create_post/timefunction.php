<?php

date_default_timezone_set('Africa/Lagos');

function time_posted($timestamp){
    $time_ago = strtotime($timestamp);
    $current_time =  time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes = round($seconds / 60); //Value 60 is seconds
    $hours = round($seconds / 3600); //Value 3600 is 60 minutes * 60 Sec
    $days = round($seconds / 86400); ///86400 = 24 * 60 * 60
    $weeks = round($seconds / 604800); //7*24*60*60
    $months = round($seconds / 2629440); //((365+365+365+365+365) / 5/ 12)*24*60*60
    $years = round($seconds / 31553280); //(365+365+365+365+365) / 5 *

    if($seconds <= 60){
        //For Seconds
        return "Just Now";
    }elseif($minutes <= 60){
        if($minutes == 1){
            return "1m ago";
        }else{
            return $minutes . "m ago";
        }
    }elseif($hours <= 24){
        if($hours == 1){
            return "1hr ago";
        }else{
            return $hours . " Hours Ago";
        }
    }elseif ($days <= 7) {
        if($days == 1){
            return "Yesterday";
        }else{
            return $days . " Days ago";
        }
    }elseif ($weeks <= 4.3) //4.3 == 52/12
     {
        if($weeks == 1){
            return "A Week ago";
        }else{
            return $weeks . " Weeks ago";
        }
    }elseif ($months <= 12) {
        if($months == 1){
            return "A Month ago";
        }else{
            return $months . " Months ago";
        }
    }elseif ($years ==1) {
        return "A Year ago";
    }else{
        return $years . " Years ago";
    }
}



?>