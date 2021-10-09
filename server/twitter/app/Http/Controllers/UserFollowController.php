<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
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
    public function usersData(){
        $user_id = Auth::user()->id;
        $all_users = User::with('follows')->where('id','!=',$user_id)->get();
        
        return response()->json($all_users);
    }
    //followPage
    public function followsData(User $user){
        $user_id = Auth::user()->id;
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();
        $following_user = User::whereIn('id', $follow_ids)->orderBy('created_at','desc')->get();

        return response()->json($following_user);
    }
    //followerPage
    public function followerData(){
        $user_id = Auth::user()->id;
        $followed_ids= Follow::where('followed_id',$user_id)->select('following_id')->get();
        $follower_user = User::whereIn('id', $followed_ids)->orderBy('created_at','desc')->get();

        return response()->json($follower_user);
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
