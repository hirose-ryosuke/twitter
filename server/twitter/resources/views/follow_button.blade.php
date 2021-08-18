
<!DOCTYPE html>
<html lang="ja">
<head>
@include('head')  
</head>
<body>
@if(Auth::check())

    @if (Auth::id() != $user->id)

        @if (Auth::user()->isFollowing($user->id))
        
            {!! Form::open(['route' => ['unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('このユーザのフォローを外す', ['class' => "follow_button_inner"]) !!}
            {!! Form::close() !!}
            
        @else
        
            {!! Form::open(['route' => ['follow', $user->id]]) !!}
                {!! Form::submit('このユーザをフォローする', ['class' => "follow_button_inner"]) !!}
            {!! Form::close() !!}
            
        @endif
    
    @endif

@endif
</body>
</html>