<?php

namespace App\Services\MatchSimulation;

use App\Models\Team\Team;
use App\Models\Team\TeamPower;
use App\Services\MatchSimulation\Calculators\GoalProbabilityCalculator;

class MatchSimulator
{
    /**
     * Simulates a match between two teams and calculates the final scores.
     *
     * @param Team $homeTeam
     * @param Team $awayTeam
     *
     * @return array
     */
    public function simulateMatch(Team $homeTeam, Team $awayTeam): array
    {
        $homePower = $homeTeam->teamPower();
        $awayPower = $awayTeam->teamPower();

        $homeScore = $this->generateGoals($homePower, $awayPower, true);
        $awayScore = $this->generateGoals($awayPower, $homePower, false);

        return [
            'home_score' => $homeScore,
            'away_score' => $awayScore,
        ];
    }

    /**
     * Generates the number of goals for a match based on attacking and defensive powers.
     *
     * @param TeamPower $attackingPower
     * @param TeamPower $defensivePower
     * @param bool      $isHome
     *
     * @return int
     */
    private function generateGoals(TeamPower $attackingPower, TeamPower $defensivePower, bool $isHome): int
    {
        $goalProbability = GoalProbabilityCalculator::calculateGoalProbability($attackingPower, $defensivePower, $isHome);

        $attempts = $this->calculateAttempts($attackingPower, $defensivePower, $goalProbability);

        return $this->calculateGoals($goalProbability, $attempts);

    }

    /**
     * Calculates the number of goal-scoring opportunities.
     *
     * @param TeamPower $attackingPower
     * @param TeamPower $defensivePower
     * @param float     $goalProbability
     *
     * @return int
     */
    private function calculateAttempts(TeamPower $attackingPower, TeamPower $defensivePower, float $goalProbability): int
    {
        $attackStrength  = $attackingPower->attack * $goalProbability; // Gol atma gücü
        $defenseStrength = $defensivePower->defense; // Savunma gücü

        // Deneme sayısını belirle
        return max(1, min(100, round($attackStrength / $defenseStrength * 10))); // 1 ile 100 arasında deneme
    }

    /**
     * Calculated Goals
     *
     * @param float $goalProbability
     * @param int   $attempts
     *
     * @return int
     */
    private function calculateGoals(float $goalProbability, int $attempts): int
    {
        $goals = 0;

        for ($attemptIndex = 0; $attemptIndex < $attempts; $attemptIndex++) {
            if (rand(0, 100) / 100 < $goalProbability) {
                $goals++;
            }
        }

        return $goals;
    }
}
