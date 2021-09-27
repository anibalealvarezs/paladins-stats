<?php

namespace Anibalealvarezs\Paladins\Helpers;

use Anibalealvarezs\Paladins\Models\PsAbility;
use Anibalealvarezs\Paladins\Models\PsChampion;
use Anibalealvarezs\Paladins\Models\PsItem;
use Anibalealvarezs\Paladins\Models\PsMatchsHistory;
use Anibalealvarezs\Paladins\Models\PsPlayer;
use Anibalealvarezs\Paladins\Models\PsRankedData;
use Anibalealvarezs\Paladins\Models\PsTalent;
use Anibalealvarezs\Projectbuilder\Helpers\PbHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
                    $exampleItem = PsItem::first();
                    if ($exampleItem) {
                        $useAPI = false;
                        $items = PsItem::with('champion')->get()->toArray();
                        print("<pre>".print_r($items,true)."</pre>");
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
                    // Save Abilities
                    $equivalences = PsAbility::equivalences();
                    $counter = 1;
                    while ($counter <= 5) {
                        if ($d['AbilityId'.$counter]) {
                            $ability = PsAbility::getInstanceByAbilityId($d['AbilityId'.$counter]);
                            if (!$ability) {
                                $newAbility = new PsAbility();
                                $newAbility->ability_id = $d['AbilityId'.$counter];
                                $newAbility->name = $d['Ability'.$counter];
                                $newAbility->champion_id = $d['id'];
                                foreach($equivalences as $key => $value) {
                                    $newAbility->{$key} = $d['Ability_'.$counter][$value];
                                }
                                $newAbility->save();
                            }
                        }
                        $counter++;
                    }
                    // Save Champion
                    $equivalences = PsChampion::equivalences();
                    $champion = PsChampion::getInstanceByChampionId($d['id']);
                    if (!$champion) {
                        $newChampion = new PsChampion();
                        foreach($equivalences as $key => $value) {
                            if (in_array($key, ['on_rotation', 'on_weekly_rotation'])) {
                                $newChampion->{$key} = filter_var($d[$value], FILTER_VALIDATE_BOOLEAN);
                            } else {
                                $newChampion->{$key} = $d[$value];
                            }
                        }
                        $newChampion->save();
                    }
                }
                break;
            case 'getPlayerMatchHistory':
                foreach($data as $d) {
                    // Save Talents
                    $counter = 1;
                    while ($counter <= 6) {
                        if ($d['ItemId'.$counter]) {
                            $talent = PsTalent::getInstanceByTalentId($d['ItemId'.$counter]);
                            if (!$talent) {
                                $newTalent = new PsTalent();
                                $newTalent->talent_id = $d['ItemId'.$counter];
                                $newTalent->name = $d['Item_'.$counter];
                                $newTalent->champion_id = $d['ChampionId'];
                                $newTalent->save();
                            }
                        }
                        $counter++;
                    }
                    // Save Match
                    $equivalences = PsMatchsHistory::equivalences();
                    $match = PsMatchsHistory::getCollectionByMatchId($d['Match'], $d['playerId']);
                    if (count($match) == 0) {
                        $newMatch = new PsMatchsHistory();
                        foreach($equivalences as $key => $value) {
                            if (in_array($key, ['match_datetime'])) {
                                $newMatch->{$key} = Carbon::createFromFormat('n/j/Y g:i:s A', $d[$value])->toDateTimeString();
                            } else {
                                $newMatch->{$key} = $d[$value];
                            }
                        }
                        $newMatch->save();
                    }
                }
                break;
            case 'getPlayer':
            case 'getPlayerBatch':
                foreach($data as $d) {
                    // Save Rankeds
                    $equivalences = PsRankedData::equivalences();
                    $names = [
                        'RankedConquest' => 'Conquest',
                        'RankedController' => 'Ranked Controller',
                        'RankedKBM' => 'Ranked KBM'
                    ];
                    foreach ($names as $key => $value) {
                        $ranked = PsRankedData::getInstanceByPlayerId($d['ActivePlayerId'], $value);
                        if (!$ranked) {
                            $newRanked = new PsRankedData();
                            $newRanked->player_id = $d['ActivePlayerId'];
                            foreach($equivalences as $key2 => $value2) {
                                $newRanked->{$key2} = $d[$key][$value2];
                            }
                            $newRanked->save();
                        }
                    }
                    // Save Player
                    $equivalences = PsPlayer::equivalences();
                    $player = PsPlayer::getInstanceByPlayerId($d['ActivePlayerId']);
                    if (!$player) {
                        $newPlayer = new PsPlayer();
                        foreach($equivalences as $key => $value) {
                            if (in_array($key, ['created_datetime', 'last_login_datetime'])) {
                                $newPlayer->{$key} = Carbon::createFromFormat('n/j/Y g:i:s A', $d[$value])->toDateTimeString();
                            } else {
                                $newPlayer->{$key} = $d[$value];
                            }
                        }
                        $newPlayer->save();
                    }
                }
                break;
            case 'getItems':
                // Save Items
                $equivalences = PsItem::equivalences();
                foreach($data as $d) {
                    $item = PsItem::getInstanceByItemId($d['ItemId']);
                    if (!$item) {
                        $newItem = new PsItem();
                        foreach($equivalences as $key => $value) {
                            $newItem->{$key} = $d[$value];
                        }
                        $newItem->save();
                    }
                }
                break;
            default:
                break;
        }
    }
}
