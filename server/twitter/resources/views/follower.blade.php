@extends('layouts.app')
<head>
@include('head')  
    <title>Follower List</title>
</head>
@section('content')
    <section class="section_following">
            <div class="follower_wrapper" id="follower">
                @include('nav')
                <div class="following_box">
                    <h2 class="text-info">フォロワー</h2>
                    <div class="following_partition">
                        <div class="following_inwrapper" v-for="follower in followed" :key="follower.id">
                            <div class="following_inwrapper_inner">
                                <div class="profile_container">
                                    <div class="image_container">
                                        <img class="following-profile_image" :src="'storage/images/' + follower.product_image" alt="">
                                    </div>
                                    <div class="following_inbox">
                                        <p class="following_username" >@{{follower.name}}</p>
                                        <p class="following_mention" >@{{follower.mention}}</p>
                                    </div>
                                </div>
                                <div class="following_inpartition">
                                    <div class="follow_button follow_button2" v-if="follower.isFollow">
                                        <button class="follow_button_inner" @click="usersUnFollow(follower)">フォローをやめる</button>
                                    </div>
                                    <div class="follow_button follow_button2" v-else>
                                        <button class="follow_button_inner" @click="usersFollow(follower)">フォローする</button>
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
    <script src="{{ asset('js/follower.js') }}" defer></script>
@endsection
