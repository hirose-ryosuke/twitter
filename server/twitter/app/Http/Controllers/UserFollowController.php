<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends Controller
{
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }

    //他のユーザーページ//
    public function index(User $user,Follow $follow){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $all_users = User::where('id','!=',$user_id)->get();

        $users = new User;
        $all_users -> product_image =$users->product_image;
        $all_users -> name =$users->name;
        $all_users -> mention =$users->mention;

        $login_user = auth()->user();
        $is_following = $user->isFollowing($login_user->id);
        $is_followed = $user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view("/users_list",compact("all_users","user_id","user","users","follow","follow_count","follower_count","login_user"));
    }

    //フォロー中ページ//
    public function following(User $user,Request $request,Follow $follow){
        $user_id = Auth::user()->id;
        $all_users = User::where('id','!=',$user_id)->get();
        $user = User::where('id',$user_id)->first();
        $following_user = Follow::with('User')->where('following_id',$user_id)->get();


        $login_user = auth()->user();
        $is_following = $user->isFollowing($login_user->id);
        $is_followed = $user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view("/following",compact("all_users","user_id","users","user","follow","follow_count","follower_count","login_user","following_user"));
    }

    //フォロワーページ//
    public function follower(User $user,Request $request,Follow $follow){
        $user_id = Auth::user()->id;
        $all_users = User::where('id','!=',$user_id)->get();
        $user = User::where('id',$user_id)->first();

        $login_user = auth()->user();
        $is_following = $user->isFollowing($login_user->id);
        $is_followed = $user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('/follower',compact("all_users","user_id","users","user","follow","follow_count","follower_count","login_user"));
    }

    //フォローしているユーザーのID取得//
    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
    }

    //vue
    //UsersPage
    public function usersData(User $user,Follow $follow){
        $user_id = Auth::user()->id;
        $users = User::with('follows')->where('id', '!=', $user_id)->get();

        return response()->json($users);
    }

    //follow機能
    public function follow(User $user,$id) {
        $user_id = Auth::user()->id;
        $follow = new Follow();
        $follow->following_id = $user_id;
        $follow->followed_id = $id;
        $follow->timestamps = false;
        $follow->save();

        $followCount = count(Follow::where('followed_id', $id)->get());

        return response()->json($followCount);
    }

    //フォロー解除機能
    public function unfollow(User $user,$id) {
        $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $id)->first();
        $follow->delete();

        $followCount = count(Follow::where('followed_id', $id)->get());

        return response()->json($followCount);
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }
}
