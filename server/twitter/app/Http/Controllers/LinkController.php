<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twitter;
use App\User;
use Auth;
use Carbon\Carbon;

class LinkController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $tweets = Twitter::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        
        return view ('top', compact("tweets", "user_id"));
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
