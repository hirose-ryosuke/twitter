
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Follower List</title>
</head>
<body>
    {{$user->id}}
    {{Auth::id()}}
@if(Auth::check())

    @if (Auth::id() != $user->id)

        @if (Auth::user()->is_following($user->id))
        
            {!! Form::open(['route' => ['unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('このユーザのフォローを外す', ['class' => "button btn btn-danger mt-1"]) !!}
            {!! Form::close() !!}
            
        @else
        
            {!! Form::open(['route' => ['follow', $user->id]]) !!}
                {!! Form::submit('このユーザをフォローする', ['class' => "button btn btn-primary mt-1"]) !!}
            {!! Form::close() !!}
            
        @endif
    
    @endif

@endif
</body>
</html>