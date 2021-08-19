<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Twitter extends Model
{
    protected $fillable = ['id'];
    protected $table = 'tweets';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function FollowModel()
    {
        return $this->hasMany('App\Follow');
    }
    public function favorite() {
        return $this->belongsTo('App\Favorite', 'foreign_key','id');
    }
    public function getCreatedAtAttribute($value)
    {

        $carbon = new Carbon($value);
        return $carbon->isoFormat('YYYY年MM月DD日 H時m分s秒  ');
    }
    //Favoriteへのリレーション//
    public function favorite_users()
    {
            return $this->belongsToMany(self::class,'favorites','id','user_id')->withTimestamps();
    }
}
