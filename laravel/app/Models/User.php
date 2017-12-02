<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_user_name',
        'u_email',
        'u_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'u_password',
        'u_remember_token',
    ];

    protected $table = 'users';

    protected $primaryKey = 'u_id';

    public function cards()
    {
        return $this->hasMany('App/Card');
    }
}
