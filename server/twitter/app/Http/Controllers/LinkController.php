<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twitter;
use App\User;

use Auth;
use Carbon\Carbon;

class LinkController extends Controller
{
    public function index(User $users)
    {
        $user_id = Auth::user()->id;
        
        $tweets = Twitter::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        $user = User::where('id', $user_id)->first();

        $follow_count =$users->getFollowCount($users->id);
        $follower_count = $users->getFollowerCount($users->id);

        return view('top', compact("tweets","user_id","user","follow_count","follower_count",));
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
    
}
