
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Twitter Profile</title>
</head>
<body>

    <section class="section_profile">
        <h2>PROFILE</h2>
        <a href="/" class="return_button">戻る</a>
        <div class="profile_wrapper">
            <div class="profile_box">
                
                <div class="profile_partition">
                    <form route="/users/{$user->id}/edit" method="POST" action="/edit" enctype="multipart/">
                    @csrf

                        
                        <p> 
                            Profile_image:<input type="file" name="users_image" class="input-file"
                            id="image_url">
                        </p>
                        <img src="{{ asset('storage/avatar/' . $user->image_path) }}"alt="">
                        <p>
                            name：<input id="name" type="text" name="name" value="{{$user->name}}"required>
                        </p>
                        
                        <p>
                            E-mail：<input id="email" type="text" name="email" value="{{$user->email}}"required>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>
                        <p>
                            mention：<input id="mention" type="text" name="mention" value="{{$user->mention}}"required>
                            @error('mention')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>
                        <p>
                            password：<input id="password" type="text"  name="password"  autocomplete="new-password"  >
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>
                        <p>
                            password：<input id="password-confirm" type="text"  name="password_confirmation"  autocomplete="new-password">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>
                    
                </div>  
            </div>
        </div>
    </section>

        
</body>
</html>