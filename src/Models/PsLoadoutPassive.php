<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsLoadoutPassive extends PsBuilder
{
    protected $table = 'loadout_passives';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loadout_id', 'passive_id', 'points'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function loadout(): BelongsTo
    {
        return $this->belongsTo(PsLoadout::class);
    }
}
