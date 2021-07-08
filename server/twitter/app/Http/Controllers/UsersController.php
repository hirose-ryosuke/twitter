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
        
        $user = User::find('id');
        return view('profile');
    }

    public function update(Request $request,User $user)
    {
        return view('profile', compact('user'));
    }

    public function edit(Request $request,User $user)
    {  

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
        // return redirect('/edit-page/1');
        
        $filename = userIDとランダムの文字列の組み合わせ;
        $path = $request->file('image')->store('public/image_url');
        $user->image_path = 'string';
        $user->save();

        return view('/edit-page', compact('user'))->with('filename', basename($path));
    }
    
}
