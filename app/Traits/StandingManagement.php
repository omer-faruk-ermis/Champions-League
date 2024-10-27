<?php

namespace App\Traits;

use App\Constants\DefaultConstant;
use App\Constants\MatchStatus;
use App\Models\Fixture;
use App\Models\Standing;
use Illuminate\Support\Collection;

/**
 * Trait StandingManagement
 *
 * @package App\Traits
 *
 */
trait StandingManagement
{
    /**
     * @param $leagueId
     *
     * @return Collection
     */
    protected function getStandingsByLeagueId($leagueId): Collection
    {
        return Standing::with(['team', 'league'])
            ->where('league_id', $leagueId)
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * @param Collection $standings
     *
     * @return void
     */
    protected function resetStandings(Collection $standings): void
    {
        foreach ($standings as $standing) {
            $standing->played        = DefaultConstant::INITIAL_SCORE;
            $standing->points        = DefaultConstant::INITIAL_SCORE;
            $standing->goals_for     = DefaultConstant::INITIAL_SCORE;
            $standing->goals_against = DefaultConstant::INITIAL_SCORE;
            $standing->won           = DefaultConstant::INITIAL_SCORE;
            $standing->drawn         = DefaultConstant::INITIAL_SCORE;
            $standing->lost          = DefaultConstant::INITIAL_SCORE;
        }
    }

    /**
     * @param Collection $standings
     * @param            $leagueId
     *
     * @return void
     */
    protected function updateStandingsFromFixtures(Collection $standings, $leagueId): void
    {
        $fixtures = Fixture::where('league_id', $leagueId)
            ->whereNull('deleted_at')
            ->get();

        foreach ($fixtures as $fixture) {
            if ($fixture->match_status === MatchStatus::SCHEDULED) {
                $this->updateScheduledMatch($fixture, $standings);
            } elseif ($fixture->match_status === MatchStatus::COMPLETED) {
                $this->updateCompletedMatch($fixture, $standings);
            }
        }

        foreach ($standings as $standing) {
            $standing->save();
        }
    }

    /**
     * @param            $fixture
     * @param Collection $standings
     *
     * @return void
     */
    protected function updateScheduledMatch($fixture, Collection $standings): void
    {
        $homeStanding = $standings->firstWhere('team_id', $fixture->home_team_id);
        $awayStanding = $standings->firstWhere('team_id', $fixture->away_team_id);

        $homeStanding->points    += DefaultConstant::INITIAL_SCORE;
        $awayStanding->points    += DefaultConstant::INITIAL_SCORE;
        $homeStanding->goals_for += DefaultConstant::INITIAL_SCORE;
        $awayStanding->goals_for += DefaultConstant::INITIAL_SCORE;
    }

    /**
     * @param            $fixture
     * @param Collection $standings
     *
     * @return void
     */
    protected function updateCompletedMatch($fixture, Collection $standings): void
    {
        $homeScore = $fixture->home_team_score;
        $awayScore = $fixture->away_team_score;

        $homeStanding = $standings->firstWhere('team_id', $fixture->home_team_id);
        $awayStanding = $standings->firstWhere('team_id', $fixture->away_team_id);

        $homeStanding->goals_for     += $homeScore;
        $awayStanding->goals_for     += $awayScore;
        $homeStanding->goals_against += $awayScore;
        $awayStanding->goals_against += $homeScore;
        $homeStanding->played++;
        $awayStanding->played++;

        if ($homeScore > $awayScore) {
            $homeStanding->won++;
            $awayStanding->lost++;
            $homeStanding->points += DefaultConstant::WIN_SCORE;
        } elseif ($homeScore < $awayScore) {
            $awayStanding->won++;
            $homeStanding->lost++;
            $awayStanding->points += DefaultConstant::WIN_SCORE;
        } else {
            $homeStanding->drawn++;
            $awayStanding->drawn++;
            $homeStanding->points += DefaultConstant::DRAWN_SCORE;
            $awayStanding->points += DefaultConstant::DRAWN_SCORE;
        }
    }
}
