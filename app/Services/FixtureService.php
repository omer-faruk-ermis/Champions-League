<?php

namespace App\Services;

use App\Constants\LeagueStatus;
use App\Constants\MatchStatus;
use App\Exceptions\Fixture\FixtureNotFoundException;
use App\Exceptions\Fixture\LeagueNotFoundException;
use App\Models\Fixture;
use App\Models\League;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class StandingService
 *
 * @package App\Services
 */
class FixtureService
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Fixture::with([
                                 'homeTeam',
                                 'awayTeam',
                                 'league',
                             ])
            ->filter($request->all())
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Model
     * @throws FixtureNotFoundException
     */
    public function show(int $id): Model
    {
        $fixture = Fixture::with([
                                     'homeTeam',
                                     'awayTeam',
                                     'league',
                                 ])->find($id);

        if (empty($fixture)) {
            throw new FixtureNotFoundException();
        }

        return $fixture;
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return Fixture
     *
     * @throws FixtureNotFoundException
     */
    public function update(Request $request, int $id): Fixture
    {
        $fixture = Fixture::find($id);
        if (empty($fixture)) {
            throw new FixtureNotFoundException();
        }

        $fixture->update([
                             'home_team_score' => $request->input('home_team_score', $fixture->home_team_score),
                             'away_team_score' => $request->input('away_team_score', $fixture->away_team_score),
                         ]);

        return $fixture;
    }

    /**
     * @param Request $request
     *
     * @return void
     * @throws LeagueNotFoundException
     */
    public function createFixture(Request $request): void
    {
        $league = League::where('id', $request->input('league_id'))->where('league_status', LeagueStatus::PASSIVE)->first();
        if (empty($league)) {
            throw new LeagueNotFoundException();
        }

        $fixtureGenerator = new FixtureGenerator($league);
        $fixtureGenerator->createFixtures();
        (new StandingService())->store($request->input('league_id'));
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function playWeekMatches(Request $request): void
    {
        $league = League::find($request->input('league_id'));
        $matchOrder = null;
        if (!$request->input('bulk')) {
            $fixture = Fixture::where('league_id', $league->id)
                ->where('match_status', MatchStatus::SCHEDULED)
                ->orderBy('match_order', 'asc')
                ->first();

            $matchOrder = $fixture->match_order;
        }

        $fixtureGenerator = new FixtureGenerator($league);
        $fixtureGenerator->playMatches($matchOrder);

        (new StandingService())->store($request->input('league_id'));
    }
}
