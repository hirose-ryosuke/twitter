<div class="like_btn" v-show="onLikeButton(tweet)">
    @if($twitter->is_liked_by_auth_user())
        <a href="{{ route('twitter.unlike', ['id' => tweet.id]) }}" class="btn btn-danger btn-sm">お気に入り解除<span class="badge text-light">{{ $twitter->likes->count() }}</span></a>
    @else
        <a href="{{ route('twitter.like', ['id' => tweet.id]) }}" class="btn btn-warning btn-sm text-danger">お気に入り<span class="badge text-danger">{{ $twitter->likes->count() }}</span></a>
    @endif
</div>

