<?php

namespace Kazka;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kazka\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function add($fields)
    {
        $user = new self;
        $user->fill($fields);
        $user->save();
    }
    public function sendPasswordResetNotification($token)
    {
        // Добавляем свой класс.
        $this->notify(new ResetPasswordNotification($token));
    }
}
