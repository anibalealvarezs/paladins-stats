<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsTalent extends PsBuilder
{
    protected $table = 'talents';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'champion_id'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    public function matchPlayers(): MorphToMany
    {
        return $this->morphedByMany(PsMatchPlayer::class, 'talentable');
    }

    public function players(): MorphToMany
    {
        return $this->morphedByMany(PsPlayer::class, 'ptalentable');
    }
}
