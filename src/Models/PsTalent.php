<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'talent_id', 'name', 'champion_id'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByTalentId($id, $matches = "")
    {
        $matches_array = [];
        if ($matches) {
            $matches_array = explode(',', $matches);
        }
        $self = self::where('talent_id', $id)->first();
        if ($self) {
            return self::find($self->id)
                ->with(['champion', 'items', 'matches'])
                ->whereHas('matches', function ($query) use ($matches_array) {
                    if ($matches_array) {
                        $query->where('match_id', $matches_array);
                    } else {
                        $query->whereNotNull('match_id');
                    }
                });
        }
        return false;
    }

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class, 'champion_id', 'champion_id');
    }

    /**
     * Get the items for the menu.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PsMatchsHistory::class, 'talent1', 'talent_id');
    }

    public function matches(): MorphToMany
    {
        return $this->morphedByMany(PsMatchsHistory::class, 'talentable');
    }
}
