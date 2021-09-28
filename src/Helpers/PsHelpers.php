<?php

namespace Anibalealvarezs\Paladins\Helpers;

use Anibalealvarezs\Paladins\Models\PsAbility;
use Anibalealvarezs\Paladins\Models\PsLoadout;
use Anibalealvarezs\Paladins\Models\PsLoadoutPassive;
use Anibalealvarezs\Paladins\Models\PsChampionRank;
use Anibalealvarezs\Paladins\Models\PsMatch;
use Anibalealvarezs\Paladins\Models\PsChampion;
use Anibalealvarezs\Paladins\Models\PsPassive;
use Anibalealvarezs\Paladins\Models\PsMatchPlayer;
use Anibalealvarezs\Paladins\Models\PsPlayer;
use Anibalealvarezs\Paladins\Models\PsRankedData;
use Anibalealvarezs\Paladins\Models\PsTalent;
use Anibalealvarezs\Projectbuilder\Helpers\PbHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PaladinsDev\PHP\PaladinsAPI;

class PsHelpers extends PbHelpers
{
    public const DM_PACKAGE = 'Paladins';
    public const DM_DIR = 'paladins';
    public const DM_PREFIX = 'Ps';
    public const DM_NAME = 'paladins';

    function __construct()
    {
        //
    }

    public function getData($method, $var1 = null, $var2 = null, $var3 = null)
    {
        try {
            $useAPI = true;
            switch($method) {
                case 'getItems':
                    $examplePassive = PsPassive::first();
                    if ($examplePassive) {
                        $useAPI = false;
                        $passives = PsPassive::with(
                            'champion', 'players', 'matchPlayers'
                        )->get()->toArray();
                        // print("<pre>".print_r($passives,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($passives, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getChampions':
                    $exampleChampion = PsChampion::first();
                    if ($exampleChampion) {
                        $useAPI = false;
                        $champions = PsChampion::with(
                            'passives','abilities', 'talents', 'championRanks', 'loadouts', 'matches'
                        )->get()->toArray();
                        // print("<pre>".print_r($champions,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($champions, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getPlayerMatchHistory':
                    $exampleMatchPlayer = PsMatchPlayer::where('player_id', $var1)->first();
                    if ($exampleMatchPlayer) {
                        $useAPI = false;
                        $matchPlayer = PsMatchPlayer::where('player_id', $var1)->with(
                            'player','champion', 'match', 'talents', 'passives'
                        )->get()->toArray();
                        // print("<pre>".print_r($matchPlayer,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($matchPlayer, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getPlayer':
                    $examplePlayer = PsPlayer::find($var1);
                    if ($examplePlayer) {
                        $useAPI = false;
                        $player = PsPlayer::where('id', $var1)->with(
                            'passives','talents', 'rankeds', 'matchPlayers', 'championRanks', 'loadouts', 'matches'
                        )->get()->toArray();
                        // print("<pre>".print_r($player,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($player, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getPlayerBatch':
                    $array = explode(',', $var1);
                    $examplePlayer = PsPlayer::whereIn('id', $array)->first();
                    if ($examplePlayer) {
                        $useAPI = false;
                        $players = PsPlayer::whereIn('id', $array)->with(
                            'passives','talents', 'rankeds', 'matchPlayers', 'championRanks', 'loadouts', 'matches'
                        )->get()->toArray();
                        // print("<pre>".print_r($players,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($players, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getChampionRanks':
                    $exampleRank = PsChampionRank::where('player_id', $var1)->first();
                    if ($exampleRank) {
                        $useAPI = false;
                        $ranks = PsChampionRank::where('player_id', $var1)->with(
                            'champion','player'
                        )->get()->toArray();
                        // print("<pre>".print_r($ranks,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($ranks, JSON_PRETTY_PRINT);
                    }
                    break;
                case 'getPlayerLoadouts':
                    $exampleLoadout = PsLoadout::where('player_id', $var1)->first();
                    if ($exampleLoadout) {
                        $useAPI = false;
                        $loadouts = PsLoadout::where('player_id', $var1)->with(
                            'champion','player', 'passives'
                        )->get()->toArray();
                        // print("<pre>".print_r($loadouts,true)."</pre>");
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($loadouts, JSON_PRETTY_PRINT);
                    }
                    break;
                default:
                    break;
            }
            if ($useAPI) {
                switch($method) {
                    case 'getChampionCards':
                    case 'getChampionSkins':
                    case 'getChampionRecommendedItems':
                    case 'getPlayer':
                    case 'getPlayerBatch':
                    case 'getPlayerIdByName':
                    case 'getPlayerIdByPortalUserId':
                    case 'getPlayerIdsByGamertag':
                    case 'getPlayerIdInfoForXboxAndSwitch':
                    case 'getPlayerFriends':
                    case 'getChampionRanks':
                    case 'getPlayerLoadouts':
                    case 'getPlayerAchievements':
                    case 'getPlayerStatus':
                    case 'getPlayerMatchHistory':
                    case 'searchPlayers':
                    case 'getActiveMatchDetails':
                    case 'getRankedSeasons':
                    case 'getTeamDetails':
                    case 'getMatchModeDetails':
                    case 'getTeamPlayers':
                    case 'searchTeams':
                        $query = App::make(PaladinsAPI::class)->{$method}($var1);
                        break;
                    case 'getChampionLeaderboard':
                        $query = App::make(PaladinsAPI::class)->{$method}($var1, $var2);
                        break;
                    case 'getMatchIdsByQueue':
                    case 'getRankedLeaderboard':
                        $query = App::make(PaladinsAPI::class)->{$method}($var1, $var2, $var3);
                        break;
                    default:
                        $query = App::make(PaladinsAPI::class)->{$method}();
                        break;
                }
                print("<pre>".print_r($query,true)."</pre>");
                try {
                    $this->saveData($method, $query);
                } catch( Exception $e) {
                    echo "Error: ".$e->getMessage();
                }
            }
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        die();
    }

    public function saveData($element, $data)
    {
        switch($element) {
            case 'getChampions':
                foreach($data as $d) {
                    // Save/Update Champion
                    $equivalences = PsChampion::equivalences();
                    $where = ['id' => $d['id']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        if (in_array($key, ['on_rotation', 'on_weekly_rotation'])) {
                            $exec[$key] = filter_var($d[$value], FILTER_VALIDATE_BOOLEAN);
                        } else {
                            $exec[$key] = $d[$value];
                        }
                    }
                    PsChampion::updateOrCreate($where, $exec);
                    $champion = PsChampion::find($d['id']);
                        // Save/Update Abilities
                    $equivalences = PsAbility::equivalences();
                    $counter = 1;
                    while ($counter <= 5) {
                        if ($d['AbilityId'.$counter]) {
                            // Save/Update Ability
                            $where = ['id' => $d['AbilityId'.$counter]];
                            $exec = ['name' => $d['Ability'.$counter], 'champion_id' => $champion->id];
                            foreach($equivalences as $key => $value) {
                                $exec[$key] = $d['Ability_'.$counter][$value];
                            }
                            PsAbility::updateOrCreate($where, $exec);
                        }
                        $counter++;
                    }
                }
                break;
            case 'getPlayerMatchHistory':
                foreach($data as $d) {
                    // Save/Update Talents
                    $counter = 1;
                    while ($counter <= 6) {
                        if ($d['ItemId'.$counter]) {
                            // Save/Update Talent
                            $where = ['id' => $d['ItemId'.$counter]];
                            $exec = ['name' => $d['Item_'.$counter], 'champion_id' => $d['ChampionId']];
                            PsTalent::updateOrCreate($where, $exec);
                        }
                        $counter++;
                    }
                    // Save/Update Match
                    $equivalences = PsMatch::equivalences();
                    $where = ['id' => $d['Match']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        if (in_array($key, ['match_datetime'])) {
                            $exec[$key] = Carbon::createFromFormat('n/j/Y g:i:s A', $d[$value])->toDateTimeString();
                        } else {
                            $exec[$key] = $d[$value];
                        }
                    }
                    PsMatch::updateOrCreate($where, $exec);
                    $match = PsMatch::find($d['Match']);
                    // Save/Update Playerable
                    $player = PsPlayer::find($d['playerId']);
                    if ($player) {
                        $relation = DB::table('playerables')
                            ->where('player_id', $d['playerId'])
                            ->where('playerable_id', $match->id)
                            ->first();
                        if (!$relation) {
                            $match->players()->save($player);
                        }
                    }
                    // Save/Update Championable
                    $champion = PsChampion::find($d['ChampionId']);
                    if ($champion) {
                        $relation = DB::table('championables')
                            ->where('champion_id', $d['ChampionId'])
                            ->where('championable_id', $match->id)
                            ->first();
                        if (!$relation) {
                            $match->champions()->save($champion);
                        }
                    }
                    // Save/Update MatchPlayer
                    $equivalences = PsMatchPlayer::equivalences();
                    $where = ['match_id' => $d['Match'], 'player_id' => $d['playerId']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        $exec[$key] = $d[$value];
                    }
                    PsMatchPlayer::updateOrCreate($where, $exec);
                    $matchPlayer = PsMatchPlayer::where($where)->first();
                    // Save/Update Talentables
                    $counter = 1;
                    while ($counter <= 6) {
                        if ($d['ItemId'.$counter]) {
                            // Save/Update Talentable
                            $talent = PsTalent::find($d['ItemId'.$counter]);
                            if ($talent) {
                                $relation = DB::table('talentables')
                                    ->where('talent_id', $d['ItemId'.$counter])
                                    ->where('talentable_id', $matchPlayer->id)
                                    ->first();
                                if (!$relation) {
                                    $matchPlayer->talents()->save($talent);
                                }
                            }
                        }
                        $counter++;
                    }
                    // Save/Update Passivables
                    $counter = 1;
                    while ($counter <= 4) {
                        if ($d['ActiveId'.$counter]) {
                            // Save/Update Passivable
                            $passive = PsPassive::find($d['ActiveId'.$counter]);
                            if ($passive) {
                                $relation = DB::table('passivables')
                                    ->where('passive_id', $d['ActiveId'.$counter])
                                    ->where('passivable_id', $matchPlayer->id)
                                    ->first();
                                if (!$relation) {
                                    $matchPlayer->passives()->save($passive, ['passive_level' => $d['ActiveLevel'.$counter]]);
                                }
                            }
                        }
                        $counter++;
                    }
                }
                break;
            case 'getPlayer':
            case 'getPlayerBatch':
                foreach($data as $d) {
                    // Save/Update Rankeds
                    $equivalences = PsRankedData::equivalences();
                    $names = [
                        'RankedConquest' => 'Conquest',
                        'RankedController' => 'Ranked Controller',
                        'RankedKBM' => 'Ranked KBM'
                    ];
                    foreach ($names as $key => $value) {
                        // Save/Update Ranked
                        $where = ['player_id' => $d['ActivePlayerId'], 'name' => $value];
                        $exec = [];
                        foreach($equivalences as $key2 => $value2) {
                            $exec[$key2] = $d[$key][$value2];
                        }
                        PsRankedData::updateOrCreate($where, $exec);
                    }
                    // Save/Update Player
                    $equivalences = PsPlayer::equivalences();
                    $where = ['id' => $d['ActivePlayerId']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        if (in_array($key, ['created_datetime', 'last_login_datetime'])) {
                            $exec[$key] = Carbon::createFromFormat('n/j/Y g:i:s A', $d[$value])->toDateTimeString();
                        } else {
                            $exec[$key] = $d[$value];
                        }
                    }
                    PsPlayer::updateOrCreate($where, $exec);
                }
                break;
            case 'getItems':
                foreach($data as $d) {
                    // Save/Update Passive
                    $equivalences = PsPassive::equivalences();
                    $where = ['id' => $d['ItemId']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        $exec[$key] = $d[$value];
                    }
                    PsPassive::updateOrCreate($where, $exec);
                }
                break;
            case 'getChampionRanks':
                foreach($data as $d) {
                    // Save/Update ChampionRank
                    $equivalences = PsChampionRank::equivalences();
                    $where = ['champion_id' => $d['champion_id'], 'player_id' => $d['player_id']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        if (in_array($key, ['last_played'])) {
                            $exec[$key] = Carbon::createFromFormat('n/j/Y g:i:s A', $d[$value])->toDateTimeString();
                        } else {
                            $exec[$key] = $d[$value];
                        }
                    }
                    PsChampionRank::updateOrCreate($where, $exec);
                }
                break;
            case 'getPlayerLoadouts':
                foreach($data as $d) {
                    // Save/Update Loadout
                    $equivalences = PsLoadout::equivalences();
                    $where = ['id' => $d['DeckId']];
                    $exec = [];
                    foreach($equivalences as $key => $value) {
                        $exec[$key] = $d[$value];
                    }
                    PsLoadout::updateOrCreate($where, $exec);
                    $loadout = PsLoadout::find($d['DeckId']);
                    // Save/Update LoadoutPassives
                    PsLoadoutPassive::where('loadout_id', $loadout->id)->delete();
                    foreach($d['LoadoutItems'] as $l) {
                        // Save/Update LoadoutPassive
                        $where = ['loadout_id' => $loadout->id, 'passive_id' => $l['ItemId']];
                        $exec = ['points' => $l['Points']];
                        PsLoadoutPassive::updateOrCreate($where, $exec);
                    }
                }
                break;
            default:
                break;
        }
    }
}
