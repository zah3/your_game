<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

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

    protected $dates = [
        'u_created_at',
        'u_update_at',
        'u_deleted_at',
        'u_activated_at'
    ];

    const CREATED_AT = 'u_created_at';

    const UPDATED_AT = 'u_updated_at';

    const DELETED_AT = 'u_deleted_at';

    /**
     * @var string
     */
    protected $table = 'users';

    protected $primaryKey = 'u_id';

    public function cards()
    {
        return $this->hasMany('App/Card');
    }
}
