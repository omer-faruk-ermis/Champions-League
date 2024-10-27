<?php

namespace App\Services\MatchSimulation;

use App\Models\Team\Team;
use App\Services\MatchSimulation\Calculators\GoalProbabilityCalculator;

class MatchSimulator
{
    private const ATTEMPT_SCALING_FACTOR = 6;

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
        $homeScore = $this->generateGoals($homeTeam->power()->first(), $awayTeam->power()->first(), true);
        $awayScore = $this->generateGoals($awayTeam->power()->first(), $homeTeam->power()->first(), false);

        return [
            'home_score' => $homeScore,
            'away_score' => $awayScore,
        ];
    }

    /**
     * Generates the number of goals for a match based on attacking and defensive powers.
     *
     * @param object $attackingPower
     * @param object $defensivePower
     * @param bool   $isHome
     *
     * @return int
     */
    private function generateGoals(object $attackingPower, object $defensivePower, bool $isHome): int
    {
        $goalProbability = GoalProbabilityCalculator::calculateGoalProbability($attackingPower, $defensivePower, $isHome);

        $attempts = $this->calculateAttempts($attackingPower, $defensivePower, $goalProbability);

        return $this->calculateGoals($goalProbability, $attempts);

    }

    /**
     * Calculates the number of goal-scoring opportunities.
     *
     * @param object $attackingPower
     * @param object $defensivePower
     * @param float  $goalProbability
     *
     * @return int
     */
    private function calculateAttempts(object $attackingPower, object $defensivePower, float $goalProbability): int
    {
        $attackStrength  = $attackingPower->attack * $goalProbability;
        $defenseStrength = $defensivePower->defense;

        return max(1, min(100, round($attackStrength / $defenseStrength * self::ATTEMPT_SCALING_FACTOR)));
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
