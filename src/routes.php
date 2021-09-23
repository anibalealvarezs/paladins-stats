<?php

use Anibalealvarezs\Paladins\Controllers\Paladins\PsPaladinsController as PaladinsController;
use Anibalealvarezs\Paladins\Controllers\PsFrontController as FrontController;

Route::resource('paladins', PaladinsController::class)->middleware(['web', 'auth'])->name('*', 'paladins');
Route::get('/paladins', [FrontController::class, 'index'])->middleware(['web']);
