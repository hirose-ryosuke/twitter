<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','age','sex','mention','product_image','following_user_id','user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function twitter()
    {
        return $this->hasMany('App\twitter');
    }



    public function follows() {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'following_user_id');
    }
    public function followers() {
        return $this->belongsToMany(User::class, 'user_follow','following_user_id','user_id');
    }
        public function is_following($user_id)
    {
        return $this->follows()->where('following_user_id', $user_id)->exists();
    }

    public function follow($user_id)
    {
        \Log::debug($user_id);
        // すでにフォロー済みではないか？
        $existing = $this->is_following($user_id);
        \Log::debug($existing);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $user_id;
        \Log::debug($myself);
    
        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->follows()->attach($user_id);
        }
    }
    
    public function unfollow($user_id)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($user_id);
        // フォローを外す相手がユーザ自身ではないか？
        $myself = $this->id == $user_id;
    
        // すでにフォロー済み、かつフォロー相手がユーザ自身ではない場合、フォローを外す
        if ($existing && !$myself) {
            $this->follows()->detach($user_id);
        }
    }
    
}
