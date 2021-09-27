<?php

namespace Anibalealvarezs\Paladins\Models;

class PsRankedData extends PsBuilder
{
    protected $table = 'ranked_data';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'player_id', 'leaves', 'losses', 'points', 'rank', 'prev_rank', 'season', 'tier', 'trend', 'wins', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByPlayerId($player_id, $name)
    {
        $self = self::where('player_id', $player_id)->where('name', $name)->first();
        if ($self) {
            return self::find($self->id)->with('player');
        }
        return false;
    }

    /**
     * Get the menu that owns the dish.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(PsPlayer::class, 'player_id', 'player_id');
    }

    public static function equivalences()
    {
        return [
            'name' => 'Name',
            'leaves' => 'Leaves',
            'losses' => 'Losses',
            'points' => 'Points',
            'rank' => 'Rank',
            'prev_rank' => 'PrevRank',
            'season' => 'Season',
            'tier' => 'Tier',
            'trend' => 'Trend',
            'wins' => 'Wins',
            'ret_msg' => 'ret_msg',
        ];
    }
}
