<?php
    // Start Session
    session_start();

    // Includes 
    require("authentications/config_tdb.php");
    require("create_post/timefunction.php");
    require("create_post/process_post_desktop.php");
    
    
    $session = $_SESSION['unique_id'];
    $user_data = "";
    $fullname = "";

    if($session){
        // Fetch User Data
        $unique_id = $_SESSION['unique_id'];
        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `unique_id` = '$unique_id'");

        if(mysqli_num_rows($sql) == 1){
            $user_data = mysqli_fetch_assoc($sql);

            $f_name = $user_data['f_name'];
            $l_name = $user_data['l_name'];

            $fullname = "{$user_data['f_name']} {$user_data['l_name']}";
        }

    }else{
        header("location: authentications");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TWITTER</title>
    <!--================ Media Query =================-->
    <link rel="stylesheet" href="beauties/twitter.css">

    <!--================ Media Query =================-->
    <link rel="stylesheet" href="beauties/twitter_resp.css">

    <!-- For Dark Mode -->
    <link rel="stylesheet" href="beauties/darkmode.css">

    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

    <!-- jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--- Carosel Slide -->
    <link rel="stylesheet" href="beauties/carosel.css">

    <!--- Bookmark --->
    <script src="newjs/bookmark.js"></script>
</head>
<body>
    

    <section id="main">

        <!--================================== Aside Section ======================================-->
        <aside>
            <div class="logo">
                <span class="material-icons-sharp">diamond</span>
                <p>BaE</p>
            </div>


            <div class="aside-lists">
                <div class="list">
                    <span class="material-icons-sharp">home</span>
                    <p>Home</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">tag</span>
                    <p>Explore</p>
                </div>

                <div class="list">
                    <div class="not-dot-container">
                        <div class="red-dot-not">
                            <span class="material-icons-sharp">circle</span>
                        </div>
                        <span class="material-icons-sharp">notifications_none</span>
                    </div> 
                    <p>Notifications</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">mail_outline</span>
                    <p>Messages</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">bookmark_border</span>
                    <p>Bookmark</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">subject</span>
                    <p>Lists</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">person_outline</span>
                    <p>Profile</p>
                </div>

                <div class="list">
                    <span class="material-icons-sharp">expand_circle_down</span>
                    <p>More</p>
                </div>
                
                <div class="list logout">
                    <span class="material-icons-sharp">logout</span>
                    <p>Logout</p>
                </div>

                <div class="list">
                    <button class="btn">MyBaE</button>
                </div>

            </div>

            <!--================== Profile Details ======================-->
            <div class="profile-container">
                <div class="profile-container-details">
                    <div class="profile-container-pic">
                        <img src="images/pexels-dids-5499551.jpg" alt="">
                    </div>
                    <div class="profile-container-name">
                        <p>Oludowole Olumide</p>
                        <p>@Olu_develop</p>
                    </div>
                </div>
                <span class="material-icons-sharp">more_horiz</span>
            </div>



        </aside>


        <!--================================== Main Section ======================================-->
        <div class="middle">

            <div class="feeds">

                <div class="feed">
                    <div class="feed-profile-pic">
                        <img src="images/pexels-mateusz-dach-450035.jpg" alt="">
                    </div>
                    <div class="feed-content">

                        <div class="feed-profile-name">
                            <p>Oludowole Olumide</p>
                            <span class="material-icons-sharp">verified</span>
                            <p class="username">@olu_develop - 9h</p>
                        </div>


                        <div class="feed-profile-name-mobile">
                            <p class="username">@olu_develop - 9h</p>
                            <div class="fold">
                                <p>Oludowole Olumide</p>
                                <span class="material-icons-sharp">verified</span>
                            </div>
                        </div>


                        <div class="feed-content-text">
                            <p>Learn FullStack Web Development from scratch to mastery @olu_develop on Instagram and TikTok.
                                Don't forget to like my page as you watch Live Tutorials.
                            </p>
                        </div>

                        <div class="hash-tags">
                           <p>#olu_develop</p>
                        </div>

                        <div class="feed-img">
                            <img src="images/pexels-serpstat-572056.jpg" alt="">
                        </div>

                        <div class="feed-reactions">
                            <div class="reaction-container">
                                <div class="reaction twitter-color">
                                    <span class="material-icons-sharp">contact_support</span>
                                    <p>566</p>
                                </div>

                                <div class="reaction twitter-green">
                                    <span class="material-icons-sharp">autorenew</span>
                                    <p>1,838</p>
                                </div>
                                

                                <div class="reaction twitter-love-red">
                                    <span class="material-icons-sharp">favorite_border</span>
                                    <p>2033</p>
                                </div>

                                <div class="reaction twitter-color">
                                    <span class="material-icons-sharp">trending_up</span>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="feed">
                    <div class="feed-profile-pic">
                        <img src="images/pexels-mateusz-dach-450035.jpg" alt="">
                    </div>
                    <div class="feed-content">

                        <div class="feed-profile-name">
                            <p>Oludowole Olumide</p>
                            <span class="material-icons-sharp">verified</span>
                            <p class="username">@olu_develop - 9h</p>
                        </div>


                        <div class="feed-profile-name-mobile">
                            <p class="username">@olu_develop - 9h</p>
                            <div class="fold">
                                <p>Oludowole Olumide</p>
                                <span class="material-icons-sharp">verified</span>
                            </div>
                        </div>


                        <div class="feed-content-text">
                            <p>Learn FullStack Web Development from scratch to mastery @olu_develop on Instagram and TikTok.
                                Don't forget to like my page as you watch Live Tutorials.
                            </p>
                        </div>

                        <div class="hash-tags">
                           <p>#olu_develop</p>
                        </div>

                        <div class="feed-img">
                            <img src="images/pexels-kasia-palitava-10334932.jpg" alt="">
                        </div>

                        <div class="feed-reactions">
                            <div class="reaction-container">
                                <div class="reaction">
                                    <span class="material-icons-sharp">contact_support</span>
                                    <p>566</p>
                                </div>

                                <div class="reaction">
                                    <span class="material-icons-sharp">autorenew</span>
                                    <p>1,838</p>
                                </div>
                                

                                <div class="reaction">
                                    <span class="material-icons-sharp">favorite_border</span>
                                    <p>2033</p>
                                </div>

                                <div class="reaction">
                                    <span class="material-icons-sharp">trending_up</span>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="feed">
                    <div class="feed-profile-pic">
                        <img src="images/pexels-mateusz-dach-450035.jpg" alt="">
                    </div>
                    <div class="feed-content">

                        <div class="feed-profile-name">
                            <p>Oludowole Olumide</p>
                            <span class="material-icons-sharp">verified</span>
                            <p class="username">@olu_develop - 9h</p>
                        </div>


                        <div class="feed-profile-name-mobile">
                            <p class="username">@olu_develop - 9h</p>
                            <div class="fold">
                                <p>Oludowole Olumide</p>
                                <span class="material-icons-sharp">verified</span>
                            </div>
                        </div>


                        <div class="feed-content-text">
                            <p>Learn FullStack Web Development from scratch to mastery @olu_develop on Instagram and TikTok.
                                Don't forget to like my page as you watch Live Tutorials.
                            </p>
                        </div>

                        <div class="hash-tags">
                           <p>#olu_develop</p>
                        </div>

                        <div class="feed-img">
                            <img src="images/close-up-happy-redhead-man-face-smiling-with-white-teeth-camera-wearing-glasses-better-sig.jpg" alt="">
                        </div>

                        <div class="feed-reactions">
                            <div class="reaction-container">
                                <div class="reaction">
                                    <span class="material-icons-sharp">contact_support</span>
                                    <p>566</p>
                                </div>

                                <div class="reaction">
                                    <span class="material-icons-sharp">autorenew</span>
                                    <p>1,838</p>
                                </div>
                                

                                <div class="reaction">
                                    <span class="material-icons-sharp">favorite_border</span>
                                    <p>2033</p>
                                </div>

                                <div class="reaction">
                                    <span class="material-icons-sharp">trending_up</span>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>


        <!--================================== Right Section ======================================-->
        <div class="right">
            <div class="search-input">
                <span class="material-icons-sharp">search</span>
                <input type="search" name="" id="" placeholder="Search">
            </div>

            <div class="trends">
                <div class="trends-head">
                    <h1>Trends for you</h1>
                </div>

                <div class="trend-lists">
                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending</p>
                            <h1>Olu_develop</h1>
                            <p>60.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>
                    

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                    <div class="trend-list">
                        <div class="trend-content">
                            <p>Trending Tweets</p>
                            <h1>Web Development</h1>
                            <p>24.6K Tweets</p>
                        </div>
                        <span class="material-icons-sharp">more_horiz</span>
                    </div>

                </div>

            </div>


        </div>

    </section>


</body>
</html>