<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twitter;
use App\User;
use App\Follow;
use App\Like;

use Auth;
use Carbon\Carbon;

class LinkController extends Controller
{
     //favoriteButton//
    public function like(User $user,Request $request,$id)
    {        
        $tweet = Like::create([
                'reply_id' => $id,
                'user_id' => Auth::id(),
                ]);
        return response()->json($tweet);
    }
    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        return response()->json($like);
    }
    
    public function index(Follow $follow,Twitter $twitter,User $users)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $follower = Follow::with('user')->where('id',$user_id)->get();
        //自身の投稿取得//
        // $tweets = Twitter::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        //フォローしているユーザid取得//
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();
        //フォローしているユーザーと自身の投稿取得//
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->get();
        //ログインしているユーザのフォロー数、フォロワー数をカウント//
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);
        
        return view('top', compact("user_id","user","follow","follow_count","follower_count","login_user","timeLine","follow_ids","following_tweets"));
    }
    
    public function favorite(Request $request,Follow $follow,Twitter $twitter,User $users,Like $like)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        //お気に入りしている投稿のみ表示//
        $likes = Like::where('user_id',$user_id)->select('reply_id')->get();
        $like_tweet = Twitter::whereIn('id',$likes)->orderBy('created_at','desc')->get();

        return view('favorite_tweet', compact("user_id","user","likes","like_tweet"));
    }

    public function create(Request $request)
    {
        $user_id = Auth::user()->id;

        $twitter = new Twitter();
        $twitter->tweet = $request->tweet;
        $twitter->user_id = $user_id;
        $twitter->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        $twitter = Twitter::find($request->id)->delete();
        return redirect('/');
    }

    //vue
    //TopPage
    public function getData(Request $request,Follow $follows)
    {
        $user_id = Auth::user()->id;
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->get();

        return response()->json($following_tweets);
    }
    
    //tweet投稿
    public function addData(Request $request)
    {
        $user_id = Auth::user()->id;
        $tweets = new Twitter();
        $tweets->tweet = $request->tweet;
        $tweets->user_id = $user_id;
        $tweets->save();

        return response()->json($tweets);
    }

    //tweet削除
    public function deleteData(Request $request)
    {
        $tweets = Twitter::where('id',$request->id)->delete();

        return response()->json($tweets);
    }

    //favoritePage
    public function favoriteData(Request $request,Follow $follow,Twitter $twitter,User $users,Like $like)
    {
        $user_id = Auth::user()->id;
        //お気に入りしている投稿のみ表示//
        $likes = Like::where('user_id',$user_id)->select('reply_id')->get();
        $favorites = Twitter::with('user')->whereIn('id',$likes)->orderBy('created_at','desc')->get();
        \Log::debug($favorites);
        
        return response()->json($favorites);
    }
}
