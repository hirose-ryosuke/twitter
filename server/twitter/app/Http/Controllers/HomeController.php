<?php

namespace App\Http\Controllers;
use Auth;
use App\Twitter;
use App\User;
use App\Follow;
use App\Favorite;
use App\Like;
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

    public function getData(Request $request,Follow $follows)
    {
        $user_id = Auth::user()->id;
        $follow_ids= Follow::where('following_id',$user_id)->select('followed_id')->get();
        $following_tweets = Twitter::with('user')->whereIn('user_id', $follow_ids)->orWhere('user_id',$user_id)->orderBy('created_at','desc')->get();

        return response()->json($following_tweets);
    }

};