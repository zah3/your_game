<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCards extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'us_user_id_fk',
        'us_card_id_fk',
        'us_current_name',
        'us_hp',
        'us_current_max_hp',
        'us_current_hp',
        'us_defense',
        'us_current_defense',
        'us_dmg_max',
        'us_current_dmg_max',
        'us_dmg_min',
        'us_current_dmg_min',
        'us_dmg_critical',
        'us_current_dmg_critical',
        'us_critical_chance',
        'us_current_critical_chance',
        'us_experience',
        'us_star',
        'us_level',
        'us_has_luck',
        'us_created_at',
        'us_updated_at',
        'us_deleted_at'
    ];

    protected $table = 'user_cards';

    protected $primaryKey = 'us_id';

    /**
     * this function is initialize card of user which he has choosen to play with it
     */
    public function initCard()
    {
        $baseCard = $this->getBaseCard();
        /*
         * fix return;
         */
        if(!$baseCard)
            return false;
        $this->current_hp = $this->hp;
        $this->current_name = $baseCard->name;
        $this->current_defense = $this->defense;
        $this->current_dmg_min = $this->dmg_min;
        $this->current_dmg_max = $this->dmg_max;
        $this->current_dmg_critical = $this->dmg_critical;
        $this->current_critical_chance = $this->critical_chance;
        $this->update();
    }

    /**
     * @param UserCards $defender
     * @param $skillId
     */
    public function hit(UserCards $defender,$skillId)
    {
        $defenderBaseCard = $defender->getBaseCard();
        ($this->id == $defenderBaseCard->counter_card_id) ? $counterDMG = 1 : $counterDMG = 1.4;
        $defenderBaseCard->skills();
        //dd($defenderBaseCard);
    }

    /**
     * @return mixed
     */
    public function getBaseCard()
    {
        return Card::where('id','=',$this->card_id)->first();
    }
}
