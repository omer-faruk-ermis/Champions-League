<?php

namespace App\Services\MatchSimulation\Calculators;

class GoalProbabilityCalculator
{
    private const HOME_ADVANTAGE = 1.1;

    /**
     * Calculates the probability of scoring a goal based on the attacking and defensive strengths of the teams.
     *
     * @param object $homePower
     * @param object $awayPower
     * @param bool   $isHome
     *
     * @return float
     */
    public static function calculateGoalProbability(object $homePower, object $awayPower, bool $isHome): float
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
