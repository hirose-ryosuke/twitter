@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
@include('head')   
    <title>Favorite</title>
</head>
@section('content')
    <section class="section_wrapper">
        <div class="twitter_top_wrapper"id="tweet_top">
            <div class="twitter_top_box" >
                @include('nav')
                <div class="twitter_top_inwrapper">
                    <div class="twitter_top_title">
                        <p>Favorite Tweets</p>
                    </div>
                </div>
                <div class="twitter_top_inbox">
                    <div v-for="favorite in favorites" :key="favorite.id">
                        <div class="top_inbox_inner">
                            <img class="twitter_top_menu-image twitter-profile_image" :src="'storage/images/' + favorite.user.product_image"  alt="">
                            <p class="twitter_username" >@{{favorite.user.name}}</p>
                            <p class="mention" >@{{favorite.user.mention}}</p>
                            <p class="tweet_date" >@{{favorite.updated_at | moment }}</p>
                            <div class="tweet_area tweet_area_under">
                                <div class="tweet_text2"  placeholder="hello" id="tweet2" readonly >@{{favorite.tweet }}</div>
                                <div class="favorite_button">
                                    <button class="btn-warning favorite_button_inner" @click="onLikeClick(favorite)">
                                        <span class="text-danger">☆ @{{ favorite.likes_count }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const user_id = @json($user_id);
    </script>
    <script src="{{ asset('js/top.js') }}" defer></script>
@endsection