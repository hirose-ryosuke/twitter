<input type="checkbox" id="menu-toggle" class="menu-checkbox">
<label for="menu-toggle" class="menu-button"><span></span></label>
<div class="drawer-menu">
    <ul class="twitter_top_menu">
        <li class="twitter_top_menu-inner"><a href="/"><img class="twitter_top_menu-image" src="{{ asset('image/home_image.png') }}" alt="">HOME</a></li>
        <li class="twitter_top_menu-inner"><a href="/edit-page"><img class="twitter_top_menu-image" src="{{asset('/storage/images/'.$user->product_image)}}" alt="">Profile</a></li>
        <li class="twitter_top_menu-inner"><a href="/users"><img class="twitter_top_menu-image" src="{{ asset('image/users_image.png') }}" alt="">Users</a></li>
        <li class="twitter_top_menu-inner"><a href="/users-follow"><img class="twitter_top_menu-image" src="{{ asset('image/follow＿image.png') }}" alt="">Following</a></li>
        <li class="twitter_top_menu-inner"><a href="/users-follower"><img class="twitter_top_menu-image" src="{{ asset('image/follower_image.png') }}" alt="">Follower</a></li>
        <li class="twitter_top_menu-inner"><a href="/favorite"><img class="twitter_top_menu-image" src="{{ asset('image/favorite_image.png') }}" alt="">Favorite</a></li>
    </ul>
    <label for="menu-toggle" class="menu-background"></label>
</div>