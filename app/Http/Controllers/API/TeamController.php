<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Team\TeamNotFoundException;
use App\Http\Resources\Team\TeamCollection;
use App\Http\Resources\Team\TeamResource;
use App\Services\TeamService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TeamController
 *
 * @package App\Http\Controllers\API
 */
class TeamController extends Controller
{
    /** @var TeamService $teamService */
    private TeamService $teamService;

    /**
     * TeamController constructor
     */
    public function __construct(Request $request)
    {
        $this->teamService = new TeamService($request);
    }

    /**
     * @param Request $request
     *
     * @return TeamCollection
     */
    public function index(Request $request): TeamCollection
    {
        $teams = $this->teamService->index($request);

        return new TeamCollection($teams, __('messages.' . self::class . '.INDEX'));
    }

    /**
     * @param string $id
     *
     * @return TeamResource
     * @throws TeamNotFoundException
     */
    public function show(string $id): TeamResource
    {
        $team = $this->teamService->show($id);

        return new TeamResource($team, __('messages.' . self::class . '.SHOW'));
    }
}
