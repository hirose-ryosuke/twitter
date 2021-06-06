<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Twitter TOP</title>
</head>
<body>
    <section class="section_wrapper">
        <div class="twitter_top_wrapper">
            <div class="twitter_top_box">
                <span class="twitter_image"><a href="http://127.0.0.1:5500/twitter/server/twitter/resources/views/twitter_top.blade.html"><img class="twitter_logo" src="{{ asset('image/twitter_logo.svg') }}" alt=""></a></span>
                <ul class="twitter_top_menu">
                    <li class="twitter_top_menu-inner"><a href="http://127.0.0.1:5500/twitter/server/twitter/resources/views/twitter_top.blade.html"><img class="twitter_top_menu-image" src="{{ asset('image/outline_home_black_24dp.png') }}" alt="">ホーム</a></li>
                    <li class="twitter_top_menu-inner"><a href=""><img class="twitter_top_menu-image" src="{{ asset('image/outline_info_black_24dp.png') }}" alt="">お知らせ</a></li>
                    <li class="twitter_top_menu-inner"><a href=""><img class="twitter_top_menu-image" src="{{ asset('image/outline_email_black_24dp.png') }}" alt="">メッセージ</a></li>
                    <li class="twitter_top_menu-inner"><a href=""><img class="twitter_top_menu-image twitter-profile_image" src="{{ asset('image/profile.jpg') }}" alt="">プロフィール</a></li>
                </ul>
                <!-- <div class="tweet_button-first">
                    <button class="button_inner-first">Tweet</button>
                </div> -->
            </div>
            <div class="twitter_top_partition">
                <div class="twitter_top_inwrapper">
                    <div class="twitter_top_title">
                        <p>ホーム</p>
                    </div>
                    <div class="twitter_top_input-field">
                        <div class="twitter_top_input-field-top">
                            <div class="tweet_profile"><img class="twitter-profile_image2" src="{{ asset('image/profile.jpg') }}" alt=""></div>
                            <form method="POST" action="" class="tweet_area">
                                <div class="tweet_area">
                                    <p>
                                        <textarea class="tweet_text" name="tweet" id="tweet" placeholder="hello"></textarea>
                                    </p>
                                    <p><input class="button_inner-second" type="submit" value="Tweet"></p>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="space"></div>
                <div class="twitter_top_inbox">
                    <div class="top_inbox_inner">
                        <img class="twitter-profile_image2" src="{{ asset('image/profile.jpg') }}" alt="">
                        <p class="twitter_username">hirose</p>
                        <p class="twitter_id">@Hirose_twitter</p>
                        <span id="tweet_time"></span>
                        <div class="tweet_area tweet_area_under">
                            <div class="tweet_text" name="tweet" id="tweet" placeholder="hello" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        </div>
                    </div>
                    <div class="top_inbox_inner">
                        <img class="twitter-profile_image2" src="{{ asset('image/profile.jpg') }}" alt="">
                        <p class="twitter_username">hirose</p>
                        <p class="twitter_id">@Hirose_twitter</p>
                        <span id="tweet_time"></span>
                        <div class="tweet_area tweet_area_under">
                            <div class="tweet_text" name="tweet" id="tweet" placeholder="hello">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        </div>
                    </div>
                    <div class="top_inbox_inner">
                        <img class="twitter-profile_image2" src="{{ asset('image/profile.jpg') }}" alt="">
                        <p class="twitter_username">hirose</p>
                        <p class="twitter_id">@Hirose_twitter</p>
                        <span id="tweet_time"></span>
                        <div class="tweet_area tweet_area_under">
                            <div class="tweet_text" name="tweet" id="tweet" placeholder="hello">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>