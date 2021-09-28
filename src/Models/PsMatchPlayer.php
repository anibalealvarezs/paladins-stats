<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsMatchPlayer extends PsBuilder
{
    protected $table = 'match_players';

    public $timestamps = false;

    protected $appends = ['crud'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id', 'champion_id', 'player_id',
        'item_1', 'item_2', 'item_3', 'item_4', 'item_level_1', 'item_level_2', 'item_level_3', 'item_level_4',
        'assists', 'creeps', 'damage', 'damage_bot', 'damage_done_in_hand', 'damage_mitigated', 'damage_structure',
        'damage_taken', 'damage_taken_magical', 'damage_taken_physical', 'deaths', 'distance_traveled', 'gold', 'healing',
        'healing_bot', 'healing_player_self', 'talent1', 'talent2', 'talent3', 'talent4', 'talent5', 'talent6', 'kills',
        'killing_spree', 'level', 'multikill_max', 'objective_assists', 'skin', 'skin_id', 'surrendered', 'task_force',
        'team1_score', 'team2_score', 'time_in_match', 'wards_placed', 'win_status', 'winning_task_force', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(PsPlayer::class);
    }

    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(PsMatch::class);
    }

    /**
     * Get the items for the menu.
     */
    public function talents(): MorphToMany
    {
        return $this->morphToMany(PsTalent::class, 'talentable', 'talentables', 'talentable_id', 'talent_id');
    }

    /**
     * Get the items for the menu.
     */
    public function passives(): MorphToMany
    {
        return $this->morphToMany(PsPassive::class, 'passivable', 'passivables', 'passivable_id', 'passive_id');
    }

    public static function equivalences()
    {
        return [
            'match_id' => 'Match',
            'champion_id' => 'ChampionId',
            'player_id' => 'playerId',
            'item_1' => 'ActiveId1',
            'item_2' => 'ActiveId2',
            'item_3' => 'ActiveId3',
            'item_4' => 'ActiveId4',
            'item_level_1' => 'ActiveLevel1',
            'item_level_2' => 'ActiveLevel2',
            'item_level_3' => 'ActiveLevel3',
            'item_level_4' => 'ActiveLevel4',
            'assists' => 'Assists',
            'creeps' => 'Creeps',
            'damage' => 'Damage',
            'damage_bot' => 'Damage_Bot',
            'damage_done_in_hand' => 'Damage_Done_In_Hand',
            'damage_mitigated' => 'Damage_Mitigated',
            'damage_structure' => 'Damage_Structure',
            'damage_taken' => 'Damage_Taken',
            'damage_taken_magical' => 'Damage_Taken_Magical',
            'damage_taken_physical' => 'Damage_Taken_Physical',
            'deaths' => 'Deaths',
            'distance_traveled' => 'Distance_Traveled',
            'gold' => 'Gold',
            'healing' => 'Healing',
            'healing_bot' => 'Healing_Bot',
            'healing_player_self' => 'Healing_Player_Self',
            'talent1' => 'ItemId1',
            'talent2' => 'ItemId2',
            'talent3' => 'ItemId3',
            'talent4' => 'ItemId4',
            'talent5' => 'ItemId5',
            'talent6' => 'ItemId6',
            'kills' => 'Kills',
            'killing_spree' => 'Killing_Spree',
            'level' => 'Level',
            'multikill_max' => 'Multi_kill_Max',
            'objective_assists' => 'Objective_Assists',
            'skin' => 'Skin',
            'skin_id' => 'SkinId',
            'surrendered' => 'Surrendered',
            'task_force' => 'TaskForce',
            'team1_score' => 'Team1Score',
            'team2_score' => 'Team2Score',
            'time_in_match' => 'Time_In_Match_Seconds',
            'wards_placed' => 'Wards_Placed',
            'win_status' => 'Win_Status',
            'winning_task_force' => 'Winning_TaskForce',
            'ret_msg' => 'ret_msg',
        ];
    }
}
