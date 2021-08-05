<?php

namespace App\Http\Controllers;
use Auth;
use App\Twitter;
use App\User;
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
    public function index()
    {
        $user_id = Auth::user()->id;
        
        $tweets = Twitter::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        $user = User::where('id', $user_id)->first();
        return view('top', compact("tweets","user_id","user"));
    }
    
}
