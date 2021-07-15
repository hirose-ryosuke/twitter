<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Twitter extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function getCreatedAtAttribute($value)
    {

        $carbon = new Carbon($value);
        return $carbon->isoFormat('YYYY年MM月DD日 H時m分s秒  ');
    }
}
