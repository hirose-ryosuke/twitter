<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Twitter extends Model
{
    protected $guarded = ['id'];
    protected $table = 'tweets';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function nices() {
        return $this->hasMany('App\Nice');
    }
    public function getCreatedAtAttribute($value)
    {

        $carbon = new Carbon($value);
        return $carbon->isoFormat('YYYY年MM月DD日 H時m分s秒  ');
    }

}
