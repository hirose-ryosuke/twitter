<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $appends = ['isFollow'];

    public function getIsFollowAttribute()
    {
        $user_id = Auth::user()->id;
        // フォローされているuser_idを抽出
        $followers_id = Follow::where('following_id', $user_id)->pluck('followed_id')->toArray();
        return in_array($this->id, (array)$followers_id, true) ? true : false;
    }

    protected $fillable = [
        'name', 'email', 'password','age','sex','mention','product_image','following_user_id','user_id'
    ];
    public function twitter()
    {
        return $this->hasMany('App\twitter');
    }

    public function FollowModel()
    {
        return $this->hasMany('App\Follow');
    }
    
    public function Email()
    {
        return $this->hasMany('App\Email');
    }
    
    //フォロー機能//
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }

    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($id)
    {
        $user = $this->follows()->where('followed_id', $id)->exists();
        return redirect();
    }

    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }


}
