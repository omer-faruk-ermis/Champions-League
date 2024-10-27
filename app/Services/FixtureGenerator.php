<?php

namespace App\Services;

use App\Constants\DefaultConstant;
use App\Constants\LeagueStatus;
use App\Models\League;
use App\Models\Fixture;
use App\Constants\MatchStatus;
use App\Models\Team\Team;
use App\Services\MatchSimulation\MatchSimulator;
use Illuminate\Support\Collection;

class FixtureGenerator
{
    protected League     $league;
    protected Collection $teams;
    protected Collection $fixtureList;

    public function __construct(League $league)
    {
        $this->league      = $league;
        $this->teams       = $league->teams()->get();
        $this->fixtureList = collect();
    }

    /**
     * @return void
     */
    public function createFixtures(): void
    {
        $matchOrder = 1;
        $totalWeeks = (count($this->teams) - 1) * 2; // Her takım, tüm takımla hem evde hem deplasmanda oynar

        $matchups = $this->generateWeeklyMatchups();

        foreach ($matchups as $weekMatchups) {
            foreach ($weekMatchups as $matchup) {
                // Haftalık eşleşmeleri ekleyelim
                $this->fixtureList->push($this->createFixtureData($matchup['home'], $matchup['away'], $matchOrder));
            }
            $matchOrder++;
        }

        foreach ($this->fixtureList as $fixtureData) {
            Fixture::create($fixtureData);
        }

        $this->league->update(['league_status' => LeagueStatus::ACTIVE]);
    }

    /**
     * @return array
     */
    private function generateWeeklyMatchups(): array
    {
        $weeklyMatchups = [];
        $teams = $this->teams->all();
        $totalTeams = count($teams);

        if ($totalTeams % 2 !== 0) {
            $teams[] = null;
        }

        $totalRounds = ($totalTeams - 1) * 2;

        for ($round = 0; $round < $totalRounds; $round++) {
            $weekMatchups = [];

            for ($i = 0; $i < $totalTeams / 2; $i++) {
                $homeTeam = $teams[$i];
                $awayTeam = $teams[$totalTeams - 1 - $i];

                if ($homeTeam !== null && $awayTeam !== null) {
                    if ($round % 2 === 0) {
                        $weekMatchups[] = [
                            DefaultConstant::HOME => $homeTeam,
                            DefaultConstant::AWAY => $awayTeam,
                        ];
                    } else {
                        $weekMatchups[] = [
                            DefaultConstant::HOME => $awayTeam,
                            DefaultConstant::AWAY => $homeTeam,
                        ];
                    }
                }
            }

            $weeklyMatchups[] = $weekMatchups;

            $lastTeam = array_pop($teams);
            array_splice($teams, 1, 0, [$lastTeam]);
        }

        return $weeklyMatchups;
    }

    /**
     * @param Team $homeTeam
     * @param Team $awayTeam
     * @param      $match_order
     *
     * @return array
     */
    private function createFixtureData(Team $homeTeam, Team $awayTeam, $match_order): array
    {
        return [
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'match_order'  => $match_order,
            'match_status' => MatchStatus::SCHEDULED,
            'league_id'    => $this->league->id,
        ];
    }

    /**
     * @param int|null $matchOrder
     *
     * @return void
     */
    public function playMatches(int $matchOrder = null): void
    {
        $teamIds = $this->teams->pluck('id');

        $fixturesToPlay = Fixture::whereIn('home_team_id', $teamIds)
            ->whereIn('away_team_id', $teamIds)
            ->where('match_status', MatchStatus::SCHEDULED)
            ->when(!empty($matchOrder), function ($q) use ($matchOrder) {
                $q->where('match_order', $matchOrder);
            })
            ->get();

        $matchSimulator = new MatchSimulator();

        foreach ($fixturesToPlay as $fixture) {
            $homeTeam = Team::find($fixture->home_team_id);
            $awayTeam = Team::find($fixture->away_team_id);

            $matchResult = $matchSimulator->simulateMatch($homeTeam, $awayTeam);
            $this->updateFixtureStatus($fixture, $matchResult);
        }
    }

    /**
     * @param Fixture $fixture
     * @param array   $matchResult
     *
     * @return void
     */
    private function updateFixtureStatus(Fixture $fixture, array $matchResult): void
    {
        $fixture->update([
                             'match_status'    => MatchStatus::COMPLETED,
                             'home_team_score' => $matchResult['home_score'],
                             'away_team_score' => $matchResult['away_score'],
                         ]);
    }
}
