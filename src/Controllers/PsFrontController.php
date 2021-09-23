<?php

namespace Anibalealvarezs\Paladins\Controllers;

use Anibalealvarezs\Paladins\Helpers\PsHelpers;
use Anibalealvarezs\Paladins\Models\PsMenu;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Inertia\Inertia;

class PsFrontController extends Controller
{
    /**
     * @var string
     */
    private $viewsPath;

    function __construct()
    {
        $this->viewsPath = PsHelpers::DM_PACKAGE . '/Front/';
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return void
     */
    public function index($id = null)
    {
        Inertia::setRootView(PsHelpers::DM_PACKAGE.'::app');
        return Inertia::render($this->viewsPath . 'Index');
    }
}
