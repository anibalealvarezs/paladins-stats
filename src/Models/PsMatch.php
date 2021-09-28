<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsMatch extends PsBuilder
{
    protected $table = 'matches';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'map', 'match_queue_id', 'match_datetime', 'minutes', 'queue', 'region'
    ];

    /**
     * Get the items for the menu.
     */
    public function matchPlayers(): HasMany
    {
        return $this->hasMany(PsMatchPlayer::class, 'match_id', 'id');
    }

    /**
     * Get the menu that owns the dish.
     */
    public function players(): MorphToMany
    {
        return $this->morphToMany(PsPlayer::class, 'playerable', 'playerables', 'playerable_id', 'player_id');
    }

    /**
     * Get the menu that owns the dish.
     */
    public function champions(): MorphToMany
    {
        return $this->morphToMany(PsChampion::class, 'championable', 'championables', 'championable_id', 'champion_id');
    }

    public static function equivalences()
    {
        return [
            'id' => 'Match',
            'map' => 'Map_Game',
            'match_queue_id' => 'Match_Queue_Id',
            'match_datetime' => 'Match_Time',
            'minutes' => 'Minutes',
            'queue' => 'Queue',
            'region' => 'Region',
        ];
    }
}
