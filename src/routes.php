<?php

use Anibalealvarezs\Paladins\Controllers\PsFrontController as FrontController;
use Anibalealvarezs\Paladins\Helpers\PsHelpers;
use Anibalealvarezs\Paladins\Models\PsAbility;
use Anibalealvarezs\Paladins\Models\PsChampion;
use Anibalealvarezs\Paladins\Models\PsItem;
use Anibalealvarezs\Paladins\Models\PsMatchsHistory;
use Anibalealvarezs\Paladins\Models\PsPlayer;
use Anibalealvarezs\Paladins\Models\PsRankedData;
use Anibalealvarezs\Paladins\Models\PsTalent;

Route::get(
    '/abilities/{id}',
    [PsAbility::class, 'getInstanceByAbilityId']
)->middleware(['web', 'auth'])->name('*', 'abilities');
Route::get(
    '/champion/{id}/{matches?}',
    [PsChampion::class, 'getInstanceByChampionId']
)->middleware(['web', 'auth'])->name('*', 'champion');
Route::get(
    '/item/{id}',
    [PsItem::class, 'getInstanceByItemId']
)->middleware(['web', 'auth'])->name('*', 'item');
Route::get(
    '/matchs/{id}/{player_id?}/{champion_ids?}/{players?}',
    [PsMatchsHistory::class, 'getCollectionByMatchId']
)->middleware(['web', 'auth'])->name('*', 'matchs');
Route::get(
    '/player/{id}/{matches?}',
    [PsPlayer::class, 'getInstanceByPlayerId']
)->middleware(['web', 'auth'])->name('*', 'player');
Route::get(
    '/ranked/{player_id}/{$name}',
    [PsRankedData::class, 'getInstanceByPlayerId']
)->middleware(['web', 'auth'])->name('*', 'ranked');
Route::get(
    '/talent/{id}/{matches?}',
    [PsTalent::class, 'getInstanceByTalentId']
)->middleware(['web', 'auth'])->name('*', 'talent');

Route::get(
    '/paladins',
    [FrontController::class, 'index']
)->middleware(['web']);
Route::get(
    '/{method}/{var1?}/{var2?}/{var3?}',
    [PsHelpers::class, 'getData']
)->middleware(['web']);
