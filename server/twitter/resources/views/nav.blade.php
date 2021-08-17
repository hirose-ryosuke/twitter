<input type="checkbox" id="menu-toggle" class="menu-checkbox">
<label for="menu-toggle" class="menu-button"><span></span></label>
<div class="drawer-menu">
    <ul class="twitter_top_menu">
        <li class="twitter_top_menu-inner"><a href="/"><img class="twitter_top_menu-image" src="{{ asset('image/outline_home_black_24dp.png') }}" alt="">HOME</a></li>
        <li class="twitter_top_menu-inner"><a href="/edit-page"><img class="twitter_top_menu-image twitter-profile_image" src="{{asset('/storage/images/'.$user->product_image)}}" alt="">Profile</a></li>
        <li class="twitter_top_menu-inner"><a href="/users"><img class="twitter_top_menu-image" src="{{ asset('image/users.png') }}" alt="">Users</a></li>
        <li class="twitter_top_menu-inner"><a href="/users-follow"><img class="twitter_top_menu-image" src="{{ asset('image/users.png') }}" alt="">Following</a></li>
        <li class="twitter_top_menu-inner"><a href="/users-follower"><img class="twitter_top_menu-image" src="{{ asset('image/users.png') }}" alt="">Follower</a></li>
    </ul>
    <label for="menu-toggle" class="menu-background"></label>
</div>