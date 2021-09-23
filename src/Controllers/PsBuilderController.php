<?php

namespace Anibalealvarezs\Paladins\Controllers;

use Anibalealvarezs\Projectbuilder\Controllers\PbBuilderController;
use Anibalealvarezs\Paladins\Helpers\PsHelpers;
use Anibalealvarezs\Projectbuilder\Helpers\PbHelpers;
use App\Http\Requests;

class PsBuilderController extends PbBuilderController
{
    function __construct($crud_perms = false)
    {
        if (!$this->prefix) {
            $this->prefix = PsHelpers::DM_PREFIX;
        }
        if (!$this->helper) {
            $this->helper = PbHelpers::PB_VENDOR.'\\'.PsHelpers::DM_PACKAGE.'\\Helpers\\'.$this->prefix.'Helpers';
        }
        if (!$this->package) {
            $this->package = $this->helper::DM_PACKAGE;
        }

        parent::__construct($crud_perms);
    }
}
