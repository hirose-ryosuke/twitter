<?php

namespace app\Http\Controllers;

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

class UsersController extends Controller
{
    public function editPage($id)
    {       
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        return view('profile',compact("user", "user_id"));
    }

    public function edit(Request $request)
    {  
        $password = Hash::make('password');
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        $validatedData = $request->validate([
            'name' => ['string', 'max:10'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed', 'alpha_num',],
            'age' => ['digits:2'],
            'sex' => ['string',],
            'mention' => ['unique:users']
        ]);
        User::find($user_id)->update([
            'name' => $request->name,
            'mention' => $request->mention,
            'email' => $request->email,
            'password' =>$password,
        ]);
        
        return view("profile",compact('item','user_id','user','password'));
    }
    public function image(Request $request) {
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $password = Hash::make('password');
        
        $request->validate([
			'image' => 'file|image|mimes:png,jpeg,png']);
        $productImage = $request->file('image');
        $image_name = $request->file('image')->getClientOriginalName();
        $image_path = $user_id.'.'.$image_name;
        $productImagePath = $productImage->storeAs('public/image',$image_path);
        
        User::find($user_id)->update([
            'product_image' => $productImagePath,
        ]);

        \Log::debug($productImagePath);

        return view("profile",compact('password','user','user_id'));
    }
};
