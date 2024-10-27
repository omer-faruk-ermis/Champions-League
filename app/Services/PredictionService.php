<?php

namespace App\Services;

use App\Constants\MatchStatus;
use App\Models\Fixture;
use App\Models\Standing;
use App\Models\Team\TeamPower;
use App\Services\MatchSimulation\Calculators\TeamStrengthCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PredictionService
{
    protected const MAX_POINTS = 100;
    protected const BASE_SCORE = 10;

    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $standings = Standing::with(['team', 'league'])
            ->filter($request->all())
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($standing) {
                $teamStrength                      = $this->getTeamStrength($standing->team_id);
                $standing->championshipProbability = $this->calculateChampionshipProbability($standing, $teamStrength);
                return $standing;
            });

        $standings = $this->normalizeProbabilities($standings);
        return $standings->sortByDesc('championshipProbability');

    }

    /**
     * @param int $teamId
     *
     * @return float
     */
    protected function getTeamStrength(int $teamId): float
    {
        $teamPower          = TeamPower::where('team_id', $teamId)->first();
        $strengthCalculator = new TeamStrengthCalculator();

        $attackStrength  = $strengthCalculator->calculateAttackStrength($teamPower);
        $defenseStrength = $strengthCalculator->calculateDefenseStrength($teamPower);

        return ($attackStrength + $defenseStrength) / 2;
    }

    /**
     * @param       $standing
     * @param float $teamStrength
     *
     * @return float
     */
    protected function calculateChampionshipProbability($standing, float $teamStrength): float
    {
        $totalTeams = Standing::where('league_id', $standing->league_id)
            ->whereNull('deleted_at')
            ->count();

        $remainingMatches = $this->getRemainingMatches($standing->team_id);
        $currentPoints    = $standing->points;

        if ($remainingMatches > 0 && $currentPoints === 0) {
            $totalTeamStrength = Standing::where('league_id', $standing->league_id)
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($standing) {
                    return $this->getTeamStrength($standing->team_id);
                })
                ->sum();

            return min(($teamStrength / $totalTeamStrength) * self::MAX_POINTS, 100);
        }

        $probability = ($currentPoints / ($currentPoints + ($remainingMatches * self::BASE_SCORE))) * $teamStrength;
        return min($probability * self::MAX_POINTS / $totalTeams, 100);
    }

    /**
     * @param int $teamId
     *
     * @return int
     */
    protected function getRemainingMatches(int $teamId): int
    {
        return Fixture::where('match_status', MatchStatus::SCHEDULED)
            ->where('away_team_id', $teamId)
            ->orWhere('home_team_id', $teamId)
            ->count();
    }

    /**
     * Normalize the championship probabilities to ensure they sum to 100.
     *
     * @param Collection $standings
     *
     * @return Collection
     */
    protected function normalizeProbabilities(Collection $standings): Collection
    {
        $totalProbability = $standings->sum('championshipProbability');

        if ($totalProbability > 0) {
            $standings->transform(function ($standing) use ($totalProbability) {
                $standing->championshipProbability = ($standing->championshipProbability / $totalProbability) * 100;
                return $standing;
            });
        }

        return $standings;
    }
}
