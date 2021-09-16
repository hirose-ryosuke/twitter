<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  protected $fillable = ['body','id'];
  protected $appends = ['isActive'];

  public function getIsActiveAttribute()
  {
      return false;
  }
}
