<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Email extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $table = 'change_email';

    protected $fillable = [
        'id',
        'user_id',
        'new_email',
        'update_token',
    ];

    /**
     * メールアドレス確定メールを送信
     *
     * @param [type] $token
     * 
     */
    public function sendEmailResetNotification($token)
    {
        $this->notify(new ChangeEmail($token));
    }

    /**
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}
