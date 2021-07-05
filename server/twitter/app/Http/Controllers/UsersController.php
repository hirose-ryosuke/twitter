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
    protected function validator(Request $request)
    {
        $params=$request->all();
        return Validator::make($params,[
            'name' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','alpha_num',],
            'age' => ['required','digits:2'],
            'sex' => ['required', 'string',],
            'mention'=>['unique:users']
            
        ]);
    }
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

        User::find($request->id)->update([
            'name' => $request->name,
            'mention' => $request->mention,
            'email' => $request->email,
            'password' =>$request->password,
            
            
        ]);
        return redirect('/');
        
    }
    
}
