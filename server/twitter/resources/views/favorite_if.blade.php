<!DOCTYPE html>
<html lang="en">
<head>
@include('head')  
</head>
<body>
    @if(Auth::check())

        @if (Auth::id() != $user->id)

            @if (Auth::user()->is_favorite($twitter->id))

                {!! Form::open(['route' => ['favorites.unfavorite', $twitter->id], 'method' => 'delete']) !!}
                    {!! Form::submit('いいね！を外す', ['class' => "button btn btn-warning"]) !!}
                {!! Form::close() !!}

            @else

                {!! Form::open(['route' => ['favorites.favorite', $twitter->id]]) !!}
                    {!! Form::submit('いいね！を付ける', ['class' => "button btn btn-success"]) !!}
                {!! Form::close() !!}

            @endif

        @endif

    @endif
</body>
</html>