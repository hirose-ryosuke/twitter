@extends('layouts.app')
<head>
@include('head')   
    <title>Users List</title>
</head>
@section('content')
    <section class="section_following" >
        <div class="users_list_wrapper"id="users">
        @include('nav')
            <div class="following_box">
                <h2 class="follow_h2 text-info">他のユーザー</h2>
                <div class="following_partition">
                    <div class="following_inwrapper" v-for="user in users" :key="user.id">
                        <div class="following_inwrapper_inner">
                            <div class="profile_container">
                                <div class="image_container">
                                    <img class="following-profile_image" :src="'storage/images/' + user.product_image" alt="">
                                </div>
                                <div class="following_inbox">
                                    <p class="following_username" >@{{user.name}}</p>
                                    <p class="following_mention" >@{{user.mention}}</p>
                                </div>
                            </div>
                            <div class="following_inpartition">
                                <div class="follow_button follow_button2" v-if="user.isFollow">
                                    <button class="follow_button_inner" @click="usersUnFollow(user)">フォローをやめる</button>
                                </div>
                                <div class="follow_button follow_button2" v-else>
                                    <button class="follow_button_inner" @click="usersFollow(user)">フォローする</button>
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
    <script src="{{ asset('js/users.js') }}" defer></script>
@endsection
