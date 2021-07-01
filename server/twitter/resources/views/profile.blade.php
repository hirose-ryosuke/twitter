
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
                    <form method="POST" action="/edit">
                    @csrf

                        <input type="hidden" name="id" value="{{$twitter->id}}">
                        <p>
                            name：<input type="text" name="name" value="{{$twitter->user->name}}">
                        </p>
                        
                        <p>
                            E-mail：<input type="text" name="email" value="{{$twitter->user->email}}">
                        </p>
                        <p>
                            mention：<input type="text" name="mention" value="{{$twitter->user->mention}}">
                        </p>
                        <p>
                            password：<input type="text" id="password" name="password" value="{{$twitter->user->password}}">
                        </p>
                        <p>
                            password：<input id="password-confirm" type="text" name="password-confirm" value="{{$twitter->user->ConfirmPassword}}">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>
                    
                </div>  
            </div>
        </div>
    </section>

        
</body>
</html>