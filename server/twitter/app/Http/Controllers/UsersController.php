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
    public function editPage()
    {       
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        return view('profile',compact("user", "user_id"));
    }

    public function edit(Request $request)
    {  
        $password = Hash::make('password');
        $user_id = Auth::user()->id;

        $validatedData = $request->validate([
            'name' => ['string', 'max:10'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed', 'alpha_num',],
            'mention' => ['unique:users']
        ]);
        User::find($user_id)->update([
            'name' => $request->name,
            'mention' => $request->mention,
            'email' => $request->email,
            'password' =>$password,
        ]);
        
        return redirect("/edit-page");
    }
    public function image(Request $request) {
        //ユーザーID取得//
        $user_id = Auth::user()->id;

        //IDからテーブル情報取得//
        $user = User::where('id',$user_id)->first();

        //ユーザーIDから削除する画像選択//
        $delImageName = User::find($user_id)->product_image;
        //
        if ($delImageName != 'default_image.png') {
            //元画像データ削除//
            Storage::delete('public/' . $user->product_image);
        }

        //取得可能なデータの指定//
        $request->validate([
			'image' => 'file|image|mimes:png,jpeg,png']);

        //新規画像データ、データ名取得//
        $productImage = $request->file('image');
        $image_name = $request->file('image')->getClientOriginalName();

        //取得データの名前変更//
        $image_path = $user_id.'.'.$image_name;

        //新規画像データの保存先選択//
        $productImagePath = $productImage->storeAs('public',$image_path);

        //保存する際にディレクトリ名消去//
        $new_productImagePath =str_replace('%public/%','',$image_path);

        User::find($user_id)->update([
            'product_image' => $new_productImagePath,
        ]);

        //新規画像を保存//
        return redirect("/edit-page");
    }

};
