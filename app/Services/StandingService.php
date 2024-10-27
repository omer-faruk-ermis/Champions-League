<?php

namespace App\Services;

use App\Factories\StandingFactory;
use App\Models\Standing;
use App\Traits\StandingManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class StandingService
 *
 * @package App\Services
 */
class StandingService
{
    use StandingManagement;
    protected StandingFactory $standingFactory;

    public function __construct()
    {
        $this->standingFactory = new StandingFactory();
    }

    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Standing::with(['team', 'league'])
            ->filter($request->all())
            ->join('teams', 'teams.id', '=', 'standings.team_id')
            ->select('standings.*')
            ->whereNull('standings.deleted_at')
            ->orderByRaw("CASE WHEN played = 0 THEN teams.name END ASC")
            ->orderByRaw("CASE WHEN played > 0 THEN points END DESC")
            ->orderByRaw("CASE WHEN played > 0 THEN (goals_for - goals_against) END DESC")
            ->get();
    }

    /**
     * @param $leagueId
     *
     * @return void
     */
    public function store($leagueId): void
    {
        $standings = $this->getStandingsByLeagueId($leagueId);

        if ($standings->isEmpty()) {
            $this->standingFactory->createStandingsForLeague($leagueId);
            $standings = $this->getStandingsByLeagueId($leagueId);
        }

        $this->resetStandings($standings);
        $this->updateStandingsFromFixtures($standings, $leagueId);
    }
}
