@extends('layouts.app')
<head>
@include('head')   
    <title>Follow List</title>
</head>
@section('content')
    <section class="section_following">
        <div class="following_wrapper" id="follow">
        @include('nav')
            <div class="following_box">
                <h2 class="text-info">フォロー中</h2>
                <div class="following_partition">
                    <div class="following_inwrapper" v-for="follow in follows" :key="follow.id">
                        <div class="following_inwrapper_inner">
                            <div class="profile_container">
                                <div class="image_container">
                                    <img class="following-profile_image" :src="'storage/images/' + follow.product_image" alt="">
                                </div>
                                <div class="following_inbox">
                                    <p class="following_username" >@{{follow.name}}</p>
                                    <p class="following_mention" >@{{follow.mention}}</p>
                                </div>
                            </div>
                            <div class="following_inpartition">
                                <div class="follow_button follow_button2" v-if="follow.isFollow">
                                    <button class="follow_button_inner" @click="usersUnFollow(follow)">フォローをやめる</button>
                                </div>
                                <div class="follow_button follow_button2" v-else>
                                    <button class="follow_button_inner" @click="usersFollow(follow)">フォローする</button>
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
    <script src="{{ asset('js/follow.js') }}" defer></script>
@endsection
