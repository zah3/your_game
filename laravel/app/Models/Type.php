<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $fillable = [
        't_name',
        't_counter_type'
    ];

    protected $table = 'types';

    protected $primaryKey = 't_id';

    public function cards()
    {
        return $this->hasMany('App/Card');
    }
}
