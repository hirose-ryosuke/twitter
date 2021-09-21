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
        /**
     * 引数のIDに紐づくリプライにLIKEする
    *
    * @param $id リプライID
    * @return \Illuminate\Http\RedirectResponse
    */
    public function like($id)
    {
        Like::create([
        'reply_id' => $id,
        'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'You Liked the Reply.');

        return redirect()->back();
    }

    /**
     * 引数のIDに紐づくリプライにUNLIKEする
     *
     * @param $id リプライID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();
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
        $tweets = Twitter::with('user')->get();
        //フォローしているユーザーと自身の投稿取得//
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->get();

        $following_tweets_id = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->first();

        //ログインしているユーザのフォロー数、フォロワー数をカウント//
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);
        
        return view('top', compact("tweets","user_id","user","follow","follow_count","follower_count","login_user","timeLine","follow_ids","following_tweets","following_tweets_id"));
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
    public function getData(Request $request)
    {
        $user_id = Auth::user()->id;
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->get();

        return response()->json($following_tweets);
    }
    
    public function addData(Request $request)
    {
        $user_id = Auth::user()->id;
        $tweets = new Twitter();
        $tweets->tweet = $request->tweet;
        $tweets->user_id = $user_id;
        $tweets->save();

        return response()->json($tweets);
    }
    public function deleteData(Request $request)
    {
        $tweets = Twitter::where('id',$request->id)->delete();

        return response()->json($tweets);
    }
    public function onButton(Request $request)
    {
        $user_id = Auth::user()->id;

        return response()->json($user_id);
    }
}
