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
    <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <section class="section_wrapper">
            <div class="twitter_top_wrapper">
                <div class="twitter_top_box">
                    <span class="twitter_image"><a href="/"><img class="twitter_logo" src="{{ asset('image/twitter_logo.svg') }}" alt=""></a></span>
                    <ul class="twitter_top_menu">
                        <li class="twitter_top_menu-inner"><a href="/"><img class="twitter_top_menu-image" src="{{ asset('image/outline_home_black_24dp.png') }}" alt="">ホーム</a></li>
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
                                <form method="POST" action="create" class="tweet_area">
                                    @csrf
                                    <div class="tweet_area">
                                        <textarea class="tweet_text" id="tweet" name="tweet" placeholder="hello"></textarea>
                                    </div>
                                        <p><input class="button_inner-second" type="submit" action="create"></p>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="space">.</div>
                    <div class="twitter_top_inbox">
                    @foreach($twitters as $twitter)
                            <div class="top_inbox_inner">
                                <img class="twitter-profile_image2" src="{{ asset('image/profile.jpg') }}" alt="">
                                <p class="twitter_username">hirose</p>
                                <p class="twitter_id">@jjj</p>
                                <span id="tweet_time"></span>
                                <div class="tweet_area tweet_area_under">
                                    <div class="tweet_text"  placeholder="hello" id="tweet2" readonly >{{$twitter->tweet}}</div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>