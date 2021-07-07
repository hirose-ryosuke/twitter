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
        $twitter = Twitter::find($id);
        return view('profile', [
            "twitter" => $twitter
        ]);
    }
    
    public function edit(Request $request)
    {  
        $hash = Hash::make('password');

        $validatedData = $request->validate([
            'name' => ['string', 'max:10'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed', 'alpha_num',],
            'age' => ['digits:2'],
            'sex' => ['string',],
            'mention' => ['unique:users']
        ]);

        User::find($request->id)->update([
            'name' => $request->name,
            'mention' => $request->mention,
            'email' => $request->email,
            'password' =>$request->password,
        ]);
        return redirect('/edit-page/1');
        
    }
    
}
