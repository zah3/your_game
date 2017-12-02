<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardLevel2 extends Model
{
    public $timestamps = false;

    protected $table = 'card_level_2';

    protected $primaryKey = 'cl2_id';

    public function baseCard()
    {
        return $this->belongsTo('App/Card');
    }

    static public function evolve(UserCards $userCards)
    {

    }
}
