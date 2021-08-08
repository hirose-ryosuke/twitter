
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Users List</title>
</head>
<body>
    <section class="section_following">
        <h2 class="follow_h2">他のユーザ</h2>
        <a href="/" class="return_button">戻る</a>
        <a href="/users-follow"  class="return_button">フォロー中</a>
        <a href="/users-follower" class="return_button">フォロワー</a>
        <div class="following_wrapper">
            <div class="following_box">
                <div class="following_partition">
                    <div class="following_inwrapper">
                        @foreach ($all_users as $user)
                        @csrf
                            <div class="following_inwrapper_inner">
                                <img class="following-profile_image" src="{{asset('/storage/'.$user->product_image)}}"alt="">
                                <div class="following_inbox">
                                    <p class="following_username" >{{ $user->name }}</p>
                                    <p class="following_mention" >{{ '@'.$user->mention }}</p>
                                </div>
                                <div class="following_inpartition">
                                    @if (auth()->user()->isFollowed($user->id))
                                        <div class="follow_verification">
                                            <span class="verification_message">フォローされています</span>
                                        </div>
                                    @endif
                                    <div class="follow_button">
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
</body>
</html>