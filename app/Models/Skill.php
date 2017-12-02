<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable;

    protected $table = 'skills';

    protected $primaryKey = 's_id';

    public function cards()
    {
        return $this->belongsToMany('App/Card');
    }
}
