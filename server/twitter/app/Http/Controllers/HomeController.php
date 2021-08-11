<?php

namespace App\Http\Controllers;
use Auth;
use App\Twitter;
use App\User;
use App\Follow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function index(Follow $follow)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $follower = Follow::with('user')->where('id',$user_id)->get();
        //自身の投稿取得//
        $tweets = Twitter::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        //フォローしているユーザid取得//
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();

        //フォローしているユーザーと自身の投稿取得//
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->paginate(2);
        
        //ログインしているユーザのフォロー数、フォロワー数をカウント//
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);
        
        return view('top', compact("tweets","user_id","user","follow","follow_count","follower_count","login_user","timeLine","follow_ids","following_tweets"));
    }

};