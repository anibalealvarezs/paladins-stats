<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsChampionRank extends PsBuilder
{
    protected $table = 'champion_ranks';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assists', 'deaths', 'gold', 'kills', 'last_played', 'losses', 'minion_kills', 'minutes',
        'rank', 'wins', 'worshippers', 'champion_id', 'player_id', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    /**
     * Get the menu that owns the dish.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(PsPlayer::class);
    }

    public static function equivalences()
    {
        return [
            'assists' => 'Assists',
            'deaths' => 'Deaths',
            'gold' => 'Gold',
            'kills' => 'Kills',
            'last_played' => 'LastPlayed',
            'losses' => 'Losses',
            'minion_kills' => 'MinionKills',
            'minutes' => 'Minutes',
            'rank' => 'Rank',
            'wins' => 'Wins',
            'worshippers' => 'Worshippers',
            'champion_id' => 'champion_id',
            'player_id' => 'player_id',
            'ret_msg' => 'ret_msg',
        ];
    }
}
