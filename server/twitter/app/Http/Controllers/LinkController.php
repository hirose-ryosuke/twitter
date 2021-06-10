<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\twitter;
use Auth;

class LinkController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $tweets = twitter::where('user_id', $user_id)->get();
        \Log::debug($twitters);
        
        return view ('top', compact("tweets", "user_id"));
    }
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;

        $twitter = new twitter();
        $twitter->tweet = $request->tweet;
        $twitter->user_id = $user_id;
        $twitter->save();

        return redirect('/');
    }
}
