<?php

namespace App\Services;

use App\Exceptions\Team\TeamNotFoundException;
use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class TeamService
 *
 * @package App\Services
 */
class TeamService
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Team::with([
                              'leagues',
                              'power',
                              'standing',
                              'homeFixtures',
                              'awayFixtures'
                          ])
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * @param string $id
     *
     * @return Model
     * @throws TeamNotFoundException
     */
    public function show(string $id): Model
    {
        $team = Team::with([
                               'leagues',
                               'power',
                               'standing',
                               'homeFixtures',
                               'awayFixtures'
                           ])->find($id);

        if (empty($team)) {
            throw new TeamNotFoundException();
        }

        return $team;
    }
}
