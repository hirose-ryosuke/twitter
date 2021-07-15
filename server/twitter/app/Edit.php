<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    protected $dates = [
        'image_path',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
