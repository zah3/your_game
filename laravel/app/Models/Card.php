<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'c_type_id_fk',
        'c_counter_card_id_fk',
        'c_kind_of_card',
        'c_name',
        'c_hp',
        'c_defense',
        'c_dmg_max',
        'c_dmg_min',
        'c_dmg_critical',
        'c_critical_chance',
    ];

    protected $table = 'cards';

    protected $primaryKey = 'c_id';

    public function type()
    {
        return $this->belongsTo('App/Type');
    }

    public function counter()
    {
        return $this->belongsTo('App/Card');
    }

    public function destroyerCards()
    {
        return $this->hasMany('App/Card');
    }
    public function cardLevel2()
    {
        return $this->hasOne('App/CardLevel2');
    }
    public function skills()
    {
        return $this->belongsToMany('App/Skill');
    }
    public function users()
    {
        return $this->hasMany('App/User');
    }
}
