<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'n_title',
        'n_content'
    ];

    protected $dates = [
        'n_created_at',
        'n_deleted_at'
    ];

    protected $primaryKey = 'news';
}
