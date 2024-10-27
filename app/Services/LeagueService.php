<?php

namespace App\Services;

use App\Constants\LeagueStatus;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Standing;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class LeagueService
 *
 * @package App\Services
 */
class LeagueService
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return League::with(['teams'])
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function resetLeague(Request $request): void
    {
        $leagueId = $request->input('league_id');
        $league   = League::find($leagueId);

        Fixture::where('league_id', $leagueId)->delete();
        Standing::where('league_id', $leagueId)->delete();

        $league->update(['league_status' => LeagueStatus::PASSIVE]);
    }
}
