<?php

namespace App\Services\MatchSimulation\Calculators;

use App\Models\Team\TeamPower;

class GoalProbabilityCalculator
{
    private const HOME_ADVANTAGE = 1.1;

    /**
     * Calculates the probability of scoring a goal based on the attacking and defensive strengths of the teams.
     *
     * @param TeamPower $homePower
     * @param TeamPower $awayPower
     * @param bool      $isHome
     *
     * @return float
     */
    public static function calculateGoalProbability(TeamPower $homePower, TeamPower $awayPower, bool $isHome): float
    {
        $homeAttackStrength  = (new TeamStrengthCalculator)->calculateAttackStrength($homePower);
        $awayDefenseStrength = (new TeamStrengthCalculator)->calculateDefenseStrength($awayPower);

        $goalProbability = $homeAttackStrength / ($homeAttackStrength + $awayDefenseStrength);

        if ($isHome) {
            $goalProbability *= self::HOME_ADVANTAGE;
        }

        return min(1, $goalProbability);
    }
}
