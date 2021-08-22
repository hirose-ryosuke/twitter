<?php

namespace app\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Twitter;
use App\User;
use App\Email;
use App\Favorite;

use Mail;
use Auth;

use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function editPage()
    {       
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $email = Email::where('id',$user_id)->get();
        return view('profile',compact("user", "user_id","email"));
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

    //プロフィール画像の変更//
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
            Storage::delete('public/images' . $user->product_image);
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
        $productImagePath = $productImage->storeAs('public/images',$image_path);

        //保存する際にディレクトリ名消去//
        $new_productImagePath =str_replace('%public/images%','',$image_path);

        User::find($user_id)->update([
            'product_image' => $new_productImagePath,
        ]);

        //新規画像を保存//
        return redirect("/edit-page");
    }

    //メールアドレス変更処理~確認メール送信//
    public function userEmailChange(Request $request,User $users)
    {
        $user_id = Auth::user()->id;
        $users = User::where('id',$user_id)->first();
        // バリデーションチェック
        $this->validate($request, User::$editEmailRules);
        // 対象レコード取得
        $auth = Auth::user();
        // リクエストデータ受取
        $new_email = $request->input('email');
        // メール照合用トークン生成
        $update_token = hash_hmac(
        'sha256',
        str::random(40).$new_email,
        env('APP_KEY')
        );
        //前のメールアドレス//
        $user_email =$users->email;
        // 変更データ一時保存DBへレコード保存
        $change_email = new  Email;
        $change_email->user_id = $auth->id;
        $change_email->new_email = $new_email;
        $change_email->update_token = $update_token;
        $change_email->save();

        $domain =config('app.env');

        
        // 変更前後でメールアドレスが同じか確認
        $email_check = true;
        if ($user_email == $new_email) {
            $email_check = false;}
            
        // メールアドレスが変更されていない時にエラーとして処理をかえす
        $validator = Validator::make(['email' => $email_check],
        ['email' => 'accepted']);

        if ($validator->fails()) {
            return  redirect('/edit-page')
            ->with('flash_message', 'メールアドレスが変更されていません。');
        }

        // !!!!一時保存DBのデータを引き渡してメールをおくる
        Mail::send('emails.changeEmail', ['url' =>
        "{$domain}/edit-page/userEmailUpdate/?token={$update_token}"],function ($message) use ($new_email) {
            $message->to($new_email)->subject('メールアドレス確認');
        });
        //確認メールの送信のお知らせ//
        return redirect('/edit-page')->with('flash_message', '確認メールを送信しました。');
    }
     //確認完了~メールアドレスを更新、一時保存データの削除//
    public function userEmailUpdate(Request $request)
    {
        // メールからのアクセス
        // http://127.0.0.1:8000/edit-page/userEmailUpdate/?token=????????
        // トークン受け取り
        $token = $request->input('token');
        // トークン照合
        $email_change = DB::table('change_email')
        ->where('update_token', '=', $token)
        ->first();
        // 照合一致で一時保存DBのメールアドレスをDBメールアドレスに上書
        $user = User::find($email_change->user_id);
        $user->email = $email_change->new_email;
        $user->save();
        // 一時保存DBレコード削除
        DB::table('change_email')
        ->where('update_token', '=', $token)
        ->delete();
        // 変更完了通知
        // リダイレクト
        return redirect('/edit-page')->with('flash_message', 'メールアドレスが変更されました。');
    }
};
