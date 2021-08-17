<?php

namespace App;
use Illuminate\Support\Facades\DB;
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
    protected $table = 'users';
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
    public static $editEmailRules = array(

        'email' => 'required|email'
    );
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
    public function nices() {
        return $this->hasMany('App\Nice');
    }

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

    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->exists();
    }

    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }
    
    
}
