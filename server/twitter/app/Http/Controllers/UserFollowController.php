<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Twitter;
use App\User;
use App\Follow;
use Auth;
use Illuminate\Support\Facades\Storage;

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
    public function followering(User $user,Request $request,Follow $follow){
        $user_id = Auth::user()->id;
        $all_users = User::where('id','!=',$user_id)->get();
        $user = User::where('id',$user_id)->first();

        $login_user = auth()->user();
        $is_following = $user->isFollowing($login_user->id);
        $is_followed = $user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('/followering',compact("all_users","user_id","users","user","follow","follow_count","follower_count","login_user"));
    }
}
