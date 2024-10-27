<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\League\LeagueCollection;
use App\Http\Resources\SuccessResource;
use App\Services\LeagueService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LeagueController
 *
 * @package App\Http\Controllers\API
 */
class LeagueController extends Controller
{
    /** @var LeagueService $leagueService */
    private LeagueService $leagueService;

    /**
     * LeagueController constructor
     */
    public function __construct()
    {
        $this->leagueService = new LeagueService();
    }

    /**
     * @param Request $request
     *
     * @return LeagueCollection
     */
    public function index(Request $request): LeagueCollection
    {
        $leagues = $this->leagueService->index($request);

        return new LeagueCollection($leagues, __('messages.' . self::class . '.INDEX'));
    }

    /**
     * @param Request $request
     *
     * @return SuccessResource
     */
    public function resetLeague(Request $request): SuccessResource
    {
        $this->leagueService->resetLeague($request);

        return new SuccessResource(__('messages.' . self::class . '.RESET_LEAGUE'));
    }
}
