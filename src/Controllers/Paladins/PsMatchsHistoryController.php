<?php

namespace Anibalealvarezs\Paladins\Controllers\Paladins;

use Anibalealvarezs\Paladins\Controllers\PsBuilderController;
use App\Http\Requests;
use Illuminate\Http\Request;

use Auth;

class PsMatchsHistoryController extends PsBuilderController
{
    function __construct($crud_perms = false)
    {
        // Vars Override
        $this->key = 'MatchsHistory';
        // Validation Rules
        $this->validationRules = [
            'name' => ['max:128'],
            'url' => [],
            'description' => [],
            'alt' => [],
        ];
        // Model Exclude
        $this->modelExclude = ['url', 'file'];
        // Show ID column ?
        $this->showId = true;
        // Default values
        $this->defaults = [
            'status' => 1,
        ];
        // Parent construct
        parent::__construct(true);
    }
}
