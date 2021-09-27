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
        'player_id', 'name', 'avatar_id', 'avatar_url', 'created_datetime', 'hours_played', 'last_login_datetime',
        'leaves', 'level', 'loading_frame', 'losses', 'mastery_level', 'merged_players', 'minutes_played',
        'status_message', 'platform', 'region', 'team_id', 'team_name', 'tier_contest', 'tier_ranked_controller',
        'tier_ranked_kbm', 'title', 'achievements', 'worshippers', 'xp', 'wins', 'hz_gamer_tag', 'hz_player_name',
        'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByPlayerId($id, $matches = "")
    {
        $matches_array = [];
        if ($matches) {
            $matches_array = explode(',', $matches);
        }
        $self = self::where('player_id', $id)->first();
        if ($self) {
            return self::find($self->id)
                ->with(['items', 'rankeds', 'matches'])
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
        return $this->hasMany(PsMatchsHistory::class, 'player_id', 'player_id');
    }

    /**
     * Get the items for the menu.
     */
    public function rankeds(): HasMany
    {
        return $this->hasMany(PsRankedData::class, 'player_id', 'player_id');
    }

    /**
     * Get the items for the menu.
     */
    public function matches(): MorphToMany
    {
        return $this->morphToMany(PsMatchsHistory::class, 'pmatchable', 'pmatchables', 'match_id', 'match_id');
    }

    public static function equivalences()
    {
        return [
            'player_id' => 'ActivePlayerId',
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
