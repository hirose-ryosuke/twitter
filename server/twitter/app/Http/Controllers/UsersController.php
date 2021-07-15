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
        $user = User::all();
        $user_id = Auth::id();
        return view('profile',compact('user', 'user_id'));
    }

    public function edit(Request $request)
    {  
        $item =User::all();
        $validatedData = $request->validate([
            'name' => ['string', 'max:10'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed', 'alpha_num',],
            'age' => ['digits:2'],
            'sex' => ['string',],
            'mention' => ['unique:users']
        ]);
        $password = Hash::make('password');

        $user_id = Auth::user()->id();
        User::find($user_id)->update([
            'name' => $request->name,
            'mention' => $request->mention,
            'email' => $request->email,
            'password' =>$request->password,
            
        ]);
        return view('/edit-page/{{$user->id}}',['item' => $item]);
    }
    public function image(Request $request) {

        // バリデーション省略
        $originalImg = file('image');
        \Log::debug($originalImg);
        if($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            $users->image_path = str_replace('public/image/', '', $filePath);
            $users->save();
            return redirect("/edit/{$users->id}");
        }
    }
};
