<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsMatchsHistory extends PsBuilder
{
    protected $table = 'matchs_history';

    public $timestamps = false;

    protected $appends = ['crud'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id', 'champion_id', 'item_1', 'item_2', 'item_3', 'item_4', 'item_level_1', 'item_level_2', 'item_level_3', 'item_level_4',
        'assists', 'creeps', 'damage', 'damage_bot', 'damage_done_in_hand', 'damage_mitigated', 'damage_structure',
        'damage_taken', 'damage_taken_magical', 'damage_taken_physical', 'deaths', 'distance_traveled', 'gold', 'healing',
        'healing_bot', 'healing_player_self', 'talent1', 'talent2', 'talent3', 'talent4', 'talent5', 'talent6', 'kills',
        'killing_spree', 'level', 'map', 'match_queue_id', 'match_datetime', 'minutes', 'multikill_max', 'objective_assists',
        'queue', 'region', 'skin', 'skin_id', 'surrendered', 'task_force', 'team1_score', 'team2_score', 'time_in_match',
        'wards_placed', 'win_status', 'winning_task_force', 'ret_msg'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getCollectionByMatchId($id, $player_id = 0, $champion_ids = "", $players = "")
    {
        $champion_ids_array = [];
        if ($champion_ids) {
            $champion_ids_array = explode(',', $champion_ids);
        }
        $players_array = [];
        if ($players) {
            $players_array = explode(',', $players);
        }
        return self::where('match_id', $id)
            ->whereHas('player', function ($query) use ($player_id) {
                if ($player_id) {
                    $query->where('player_id', $player_id);
                } else {
                    $query->whereNotNull('player_id');
                }
            })->whereHas('champion', function ($query) use ($champion_ids_array) {
                if ($champion_ids_array) {
                    $query->whereIn('champion_id', $champion_ids_array);
                } else {
                    $query->whereNotNull('champion_id');
                }
            })->whereHas('players', function ($query) use ($players_array) {
                if ($players_array) {
                    foreach($players_array as $p) {
                        $query->whereIn('player_id', $p);
                    }
                }
            })->with(['player', 'champion', 'players', 'talents'])->get();
    }

    /**
     * Get the menu that owns the dish.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(PsPlayer::class, 'player_id', 'player_id');
    }

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class, 'champion_id', 'champion_id');
    }

    public function players(): MorphToMany
    {
        return $this->morphedByMany(PsPlayer::class, 'pmatchable', null, 'match_id');
    }

    /**
     * Get the items for the menu.
     */
    public function talents(): MorphToMany
    {
        return $this->morphToMany(PsTalent::class, 'talentable', 'talentables', 'talent_id', 'talent_id');
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
            'map' => 'Map_Game',
            'match_queue_id' => 'Match_Queue_Id',
            'match_datetime' => 'Match_Time',
            'minutes' => 'Minutes',
            'multikill_max' => 'Multi_kill_Max',
            'objective_assists' => 'Objective_Assists',
            'queue' => 'Queue',
            'region' => 'Region',
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
