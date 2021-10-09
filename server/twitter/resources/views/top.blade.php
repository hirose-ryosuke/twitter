@extends('layouts.app')
<head>
    @include('head')   
    <title>TOP</title>
</head>
@section('content')
    <section class="section_wrapper" >
        <div class="twitter_top_wrapper"id="tweet_top">
            <div class="twitter_top_box" >
                @include('nav')
                <div class="twitter_top_inwrapper">
                    <div class="twitter_top_title">
                        <p>Tweets</p>
                    </div>
                    <div class="twitter_top_input-field">
                        <div class="twitter_top_input-field-top">
                            <div class="tweet_profile">
                                <img class="twitter-profile_image2" src="{{asset('/storage/images/'.$user->product_image)}}" alt="">
                            </div>
                            <div class="tweet_area">
                                <div class="tweet_area">
                                    <textarea v-model="newTweet"class="tweet_text" id="tweet" name="tweet" placeholder="hello" ></textarea>
                                </div>
                                <div class="follow">
                                    <div class="following">
                                        <a href="/users-follow" name="follow_number" class="follow_number">{{ $follow_count }}</a>
                                        <label for="follow_number" class="follow_label">フォロー中</label>
                                    </div>
                                    <div class="follower">
                                        <a href="/users-follower" name="follower_number" class="follower_number">{{ $follower_count }}</a>
                                        <label for="follower_number" class="follower_label">フォロワー</label>
                                    </div>
                                </div>
                                <div class="tweet_button-first">
                                    <button class="button_inner-first" type="submit" @click="addData" value="tweet">投稿</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="space"></div>
            <div class="twitter_top_inbox">
                <div v-for="tweet in tweets" :key="tweet.id" >
                    <div class="top_inbox_inner">
                        <img class="twitter_top_menu-image twitter-profile_image" :src="'storage/images/' + tweet.user.product_image"  alt="">
                        <p class="twitter_username">@{{tweet.user.name}}</p>
                        <p class="mention" >@{{tweet.user.mention}}</p>
                        <p class="tweet_date" >@{{tweet.updated_at | moment }}</p>
                        <div class="tweet_area_under">
                            <div class="tweet_text2"  placeholder="hello" id="tweet2" readonly >@{{tweet.tweet}}
                            </div>
                            <!--投稿のidが自身の場合のみdeleteボタン表示-->
                            <div class="delete_button" v-show="authCheck(tweet)" >
                                <button class="delete_button_inner"  type="submit" @click="deleteData(tweet)">削除
                                </button>
                            </div>
                            <!-- favoriteボタン -->
                            <div class="favorite_button" v-show="!authCheck(tweet)">
                                <button class="btn-warning favorite_button_inner" @click="onLikeClick(tweet)">
                                    <span class="text-danger">☆ @{{ tweet.likes_count }}</span>
                                </button>
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
