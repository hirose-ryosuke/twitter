@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
@include('head')   
    <title>Favorite</title>
</head>
<body>

@section('content')
<section class="section_wrapper">
        <div class="twitter_top_wrapper">
            <div class="twitter_top_box" >
                @include('nav')

                <div class="twitter_top_inwrapper">
                    <div class="twitter_top_title">
                        <p>Favorite Tweets</p>
                    </div>
                </div>
            <div class="space">.</div>
            <div class="twitter_top_inbox">
                @foreach($like_tweet  as $twitter)
                <div class="top_inbox_inner">
                    <img class="twitter-profile_image" src="{{asset('/storage/images/'.$twitter->user->product_image)}}"alt="">
                    <p class="twitter_username" >{{$twitter->user->name}}</p>
                    <p class="mention" >{{'@'.$twitter->user->mention}}</p>
                    <p class="tweet_date" >{{$twitter->created_at}}</p>
                    <div class="tweet_area tweet_area_under">
                        @csrf
                        <div class="tweet_text2"  placeholder="hello" id="tweet2" readonly >{{$twitter->tweet}}</div>
                        @include('favorite_button')
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
</body>
</html>