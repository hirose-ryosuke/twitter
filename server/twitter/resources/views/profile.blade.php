
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Twitter Profile</title>
</head>
<body>

    <section class="section_profile">
        <h2>PROFILE</h2>
        <a href="/" class="return_button">戻る</a>
        <div class="profile_wrapper">
            <div class="profile_box">
                <div class="profile_partition">
                    <form route="image_route "method="POST"  enctype="multipart/form-data" accept="image/png, image/jpeg,image/jpg">
                    @csrf
                    <img class="profile_images_size twitter_top_menu-image twitter-profile_image " src="{{asset('/storage/images/'.$user->product_image)}}" alt="">
                        <p> 
                            <label for="image">Profile_image:</label>
                            <input type="file" name="image" class="input-file"
                            id="image">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>

                    <form action="/edit" method="POST">
                        @csrf
                        <p>
                            <label for="name">name：</label>
                            <input id="name" type="text" name="name" value="{{$user->name}}">
                        </p>
                        <p>
                            <label for="email">E-mail：</label>
                            <input id="email" type="text" name="email" value="{{$user->email}}">
                            
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>
                        <p>
                            <label for="mention">mention：</label>
                            <input id="mention" type="text" name="mention" value="{{$user->mention}}">
                            @error('mention')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>
                        <p>
                            <label for="password">新しいパスワード：</label>
                            <input id="password" type="text"  name="password"  autocomplete="new-password" >
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>
                        <p>
                            <label for="password_confirmation">新しいパスワード(確認)：</label>
                            <input id="password-confirm" type="text"  name="password_confirmation"  autocomplete="new-password">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>
                    
                </div>  
            </div>
        </div>
    </section>

        
</body>
</html>