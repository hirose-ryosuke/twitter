<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Twitter;
use App\User;
use App\Follow;
use App\Favorite;
use Illuminate\Http\Request;
class Twitter extends Model
{
    protected $fillable = ['id','user_id','tweet'];
    
    protected $appends = ['isActive','likes_count','liked_by_user'];

    /**いいねの数をカウント */
    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    /**
     * そのコメントにログインユーザー（プロフィール）がすでにいいねをおしているかチェック
     * アクセサ - liked_by_user
     * @return boolean
     */
    public function getLikedByUserAttribute()
    {
        
        if (Auth::guest()) {
            return false;
        }
        return $this->likes->contains(function ($likes) {
            return $likes->user_id === Auth::user()->id;
        });
    }
    public function getIsActiveAttribute()
    {
        return false;
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function FollowModel()
    {
        return $this->hasMany('App\Follow');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'reply_id');
    }
    public function getCreatedAtAttribute($value)
    {
        $carbon = new Carbon($value);
        return $carbon->isoFormat('YYYY年MM月DD日 H時m分s秒  ');
    }
    //     /**
    //  * リプライにLIKEを付いているかの判定
    // *
    // * @return bool true:Likeがついてる false:Likeがついてない
    // */
    // public function is_liked_by_auth_user()
    // {
    //     $id = Auth::id();

    //     $likers = array();
    //     foreach($this->likes as $like) {
    //     array_push($likers, $like->user_id);
    //     }

    //     if (in_array($id, $likers)) {
    //     return true;
    //     } else {
    //     return false;
    //     }
    // }
        
}
