<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Twitter;
use App\User;
use App\Follow;
use App\Favorite;
use Illuminate\Http\Request;
class Like extends Model
{
    // 配列内の要素を書き込み可能にする
    protected $fillable = ['reply_id','user_id'];

    public function twitter()
    {
    return $this->belongsTo(Twitter::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
