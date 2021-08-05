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
use Auth;
use Illuminate\Support\Facades\Storage;

class UserFollowController extends Controller
{   //他のユーザーページ//
    public function index(){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $all_users = User::where('id','!=',$user_id)->get();

        $users = new User;
        $all_users -> product_image =$users->product_image;
        $all_users -> name =$users->name;
        $all_users -> mention =$users->mention;
        return view("/users_list",compact("all_users","user_id","user","users"));
    }
    //フォロー中ページ//
    public function following(Request $request){
        $user_id = Auth::user()->id;
        $all_users = User::where('id','!=',$user_id)->get();

        $users = new User;
        $all_users -> product_image =$users->product_image;
        $all_users -> name =$users->name;
        $all_users -> mention =$users->mention;

        return view("/following",compact("all_users","user_id","users"));
    }
    //フォロワーページ//
    public function followering(Request $request){
        $user_id = Auth::user()->id;
        $all_users = User::where('id','!=',$user_id)->get();
        $user = User::where('id',$user_id)->first();
        $users = new User;
        $all_users -> pid =$users->id;
        $all_users -> product_image =$users->product_image;
        $all_users -> name =$users->name;
        $all_users -> mention =$users->mention;

        return view('/followering',compact("all_users","user_id","users","user"));
    }
    //フォローする//
    public function store($id)
    {   
        \Auth::user()->follow($id);
        // \Log::debug($test);

        return back();
    }
    //フォローを外す//
    public function destroy($id)
    {
        Auth::user()->unfollow($id);
        return back();
    }
    //ユーザーのカウント//
    public function counts($user) {
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();

        return [
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
        ];
    }
}
