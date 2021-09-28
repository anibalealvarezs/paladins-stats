<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsLoadout extends PsBuilder
{
    protected $table = 'loadouts';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'champion_id', 'player_id', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(PsPlayer::class);
    }

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    /**
     * Get the items for the menu.
     */
    public function passives(): HasMany
    {
        return $this->hasMany(PsLoadoutPassive::class, 'loadout_id', 'id');
    }

    public static function equivalences()
    {
        return [
            'id' => 'DeckId',
            'name' => 'DeckName',
            'champion_id' => 'ChampionId',
            'player_id' => 'playerId',
            'ret_msg' => 'ret_msg',
        ];
    }
}
