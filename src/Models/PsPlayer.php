<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsPlayer extends PsBuilder
{
    protected $table = 'players';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'avatar_id', 'avatar_url', 'created_datetime', 'hours_played', 'last_login_datetime',
        'leaves', 'level', 'loading_frame', 'losses', 'mastery_level', 'merged_players', 'minutes_played',
        'status_message', 'platform', 'region', 'team_id', 'team_name', 'tier_contest', 'tier_ranked_controller',
        'tier_ranked_kbm', 'title', 'achievements', 'worshippers', 'xp', 'wins', 'hz_gamer_tag', 'hz_player_name',
        'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function passives(): MorphToMany
    {
        return $this->morphToMany(PsPassive::class, 'ppassivable', 'ppassivables', 'ppassivable_id', 'passive_id');
    }

    /**
     * Get the menu that owns the dish.
     */
    public function talents(): MorphToMany
    {
        return $this->morphToMany(PsTalent::class, 'ptalentable', 'ptalentables', 'ptalentable_id', 'talent_id');
    }

    /**
     * Get the items for the menu.
     */
    public function rankeds(): HasMany
    {
        return $this->hasMany(PsRankedData::class, 'player_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function matchPlayers(): HasMany
    {
        return $this->hasMany(PsMatchPlayer::class, 'player_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function championRanks(): HasMany
    {
        return $this->hasMany(PsChampionRank::class, 'player_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function loadouts(): HasMany
    {
        return $this->hasMany(PsLoadout::class, 'player_id', 'id');
    }

    public function matches(): MorphToMany
    {
        return $this->morphedByMany(PsMatch::class, 'playerable', 'playerables', 'player_id', 'playerable_id');
    }

    public static function equivalences()
    {
        return [
            'id' => 'ActivePlayerId',
            'name' => 'Name',
            'avatar_id' => 'AvatarId',
            'avatar_url' => 'AvatarURL',
            'created_datetime' => 'Created_Datetime',
            'hours_played' => 'HoursPlayed',
            'last_login_datetime' => 'Last_Login_Datetime',
            'leaves' => 'Leaves',
            'level' => 'Level',
            'loading_frame' => 'LoadingFrame',
            'losses' => 'Losses',
            'mastery_level' => 'MasteryLevel',
            'merged_players' => 'MergedPlayers',
            'minutes_played' => 'MinutesPlayed',
            'status_message' => 'Personal_Status_Message',
            'platform' => 'Platform',
            'region' => 'Region',
            'team_id' => 'TeamId',
            'team_name' => 'Team_Name',
            'tier_contest' => 'Tier_Conquest',
            'tier_ranked_controller' => 'Tier_RankedController',
            'tier_ranked_kbm' => 'Tier_RankedKBM',
            'title' => 'Title',
            'achievements' => 'Total_Achievements',
            'worshippers' => 'Total_Worshippers',
            'xp' => 'Total_XP',
            'wins' => 'Wins',
            'hz_gamer_tag' => 'hz_gamer_tag',
            'hz_player_name' => 'hz_player_name',
            'ret_msg' => 'ret_msg',
        ];
    }
}
