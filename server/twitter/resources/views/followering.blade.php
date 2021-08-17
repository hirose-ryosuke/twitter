@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
@include('head')  
    <title>Follower List</title>
</head>
<body>
@section('content')
    <section class="section_following">
            <div class="following_wrapper">
                @include('nav')
                <div class="following_box">
                    <div class="following_partition">
                    <h2>フォロワー</h2>
                        <div class="following_inwrapper">
                            @foreach (auth()->user()->followers as $user)
                            @csrf
                            <div class="following_inwrapper_inner">
                                <div class="profile_container">
                                    <div class="image_container">
                                        <img class="following-profile_image" src="{{asset('/storage/images/'.$user->product_image)}}"alt="">
                                    </div>
                                    <div class="following_inbox">
                                        <p class="following_username" >{{ $user->name }}</p>
                                        <p class="following_mention" >{{ '@'.$user->mention }}</p>
                                        @if (auth()->user()->isFollowed($user->id))
                                            <div class="follow_verification">
                                                <span class="verification_message">フォローされています</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="following_inpartition">
                                    <div class="follow_button follow_button2">
                                        @include('follow_button',['user'=>$user])
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
</body>
</html>