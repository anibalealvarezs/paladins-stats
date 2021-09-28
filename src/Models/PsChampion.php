<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
        'id', 'name', 'name_english', 'on_rotation', 'on_weekly_rotation', 'card_url', 'icon_url', 'cons',
        'health', 'lore', 'pantheon', 'pros', 'roles', 'speed', 'title', 'type', 'latest_champion', 'ret_msg'
    ];

    /**
     * Get the items for the menu.
     */
    public function passives(): HasMany
    {
        return $this->hasMany(PsPassive::class, 'champion_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function abilities(): HasMany
    {
        return $this->hasMany(PsAbility::class, 'champion_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function talents(): HasMany
    {
        return $this->hasMany(PsTalent::class, 'champion_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function matchPlayers(): HasMany
    {
        return $this->hasMany(PsMatchPlayer::class, 'champion_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function championRanks(): HasMany
    {
        return $this->hasMany(PsChampionRank::class, 'champion_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function loadouts(): HasMany
    {
        return $this->hasMany(PsLoadout::class, 'champion_id', 'id');
    }

    public function matches(): MorphToMany
    {
        return $this->morphedByMany(PsMatch::class, 'championable', 'championables', 'champion_id', 'championable_id')->with('matchPlayers');
    }

    public static function equivalences()
    {
        return [
            'id' => 'id',
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
