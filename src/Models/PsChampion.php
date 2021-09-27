<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PsChampion extends PsBuilder
{
    protected $table = 'champions';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'champion_id', 'name', 'name_english', 'on_rotation', 'on_weekly_rotation', 'card_url', 'icon_url', 'cons',
        'health', 'lore', 'pantheon', 'pros', 'roles', 'speed', 'title', 'type', 'latest_champion', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByChampionId($id, $matches = "")
    {
        $matches_array = [];
        if ($matches) {
            $matches_array = explode(',', $matches);
        }
        $self = self::where('champion_id', $id)->first();
        if ($self) {
            return self::find($self->id)
                ->with(['items', 'abilities', 'talents', 'matches'])
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
     * Get the items for the menu.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PsPlayer::class, 'champion_id', 'champion_id');
    }

    /**
     * Get the items for the menu.
     */
    public function abilities(): HasMany
    {
        return $this->hasMany(PsAbility::class, 'champion_id', 'champion_id');
    }

    /**
     * Get the items for the menu.
     */
    public function talents(): HasMany
    {
        return $this->hasMany(PsTalent::class, 'champion_id', 'champion_id');
    }

    /**
     * Get the items for the menu.
     */
    public function matches(): HasMany
    {
        return $this->hasMany(PsMatchsHistory::class, 'champion_id', 'champion_id');
    }

    public static function equivalences()
    {
        return [
            'champion_id' => 'id',
            'name' => 'Name',
            'name_english' => 'Name_English',
            'on_rotation' => 'OnFreeRotation',
            'on_weekly_rotation' => 'OnFreeWeeklyRotation',
            'card_url' => 'ChampionCard_URL',
            'icon_url' => 'ChampionIcon_URL',
            'cons' => 'Cons',
            'health' => 'Health',
            'lore' => 'Lore',
            'pantheon' => 'Pantheon',
            'pros' => 'Pros',
            'roles' => 'Roles',
            'speed' => 'Speed',
            'title' => 'Title',
            'type' => 'Type',
            'latest_champion' => 'latestChampion',
            'ret_msg' => 'ret_msg',
        ];
    }
}
