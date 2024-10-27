<?php

namespace App\Factories;

use App\Constants\DefaultConstant;
use App\Models\LeagueTeam;
use App\Models\Standing;

/**
 * Class StandingFactory
 *
 * @package App\Factories
 */
class StandingFactory
{
    public function createStandingsForLeague($leagueId): void
    {
        $leagueTeams = LeagueTeam::where('league_id', $leagueId)->get();

        foreach ($leagueTeams as $team) {
            Standing::create([
                                 'team_id'       => $team->team_id,
                                 'league_id'     => $leagueId,
                                 'played'        => DefaultConstant::INITIAL_SCORE,
                                 'points'        => DefaultConstant::INITIAL_SCORE,
                                 'goals_for'     => DefaultConstant::INITIAL_SCORE,
                                 'goals_against' => DefaultConstant::INITIAL_SCORE,
                                 'won'           => DefaultConstant::INITIAL_SCORE,
                                 'drawn'         => DefaultConstant::INITIAL_SCORE,
                                 'lost'          => DefaultConstant::INITIAL_SCORE,
                             ]);
        }
    }
}
