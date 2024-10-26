<?php

namespace App\Services\MatchSimulation\Calculators;

use App\Models\Team\TeamPower;

class TeamStrengthCalculator
{
    private const FANS_SUPPORT_MODIFIER = 100;
    private const TEAM_SPIRIT_MODIFIER  = 100;
    private const NO_EFFECT             = 1;

    /**
     * Calculates the strength modifier based on fan support and team spirit.
     *
     * @param TeamPower $teamPower
     *
     * @return float
     */
    protected function calculateStrengthModifier(TeamPower $teamPower): float
    {
        return (self::NO_EFFECT + $teamPower->fan_support / self::FANS_SUPPORT_MODIFIER) *
            (self::NO_EFFECT + $teamPower->team_spirit / self::TEAM_SPIRIT_MODIFIER);
    }

    /**
     * Calculates the attack strength of a team based on its attack power and strength modifier.
     *
     * @param TeamPower $teamPower
     *
     * @return float
     */
    public function calculateAttackStrength(TeamPower $teamPower): float
    {
        return $teamPower->attack * $this->calculateStrengthModifier($teamPower);
    }

    /**
     * Calculates the defense strength of a team based on its defense power and strength modifier.
     *
     * @param TeamPower $teamPower
     *
     * @return float
     */
    public function calculateDefenseStrength(TeamPower $teamPower): float
    {
        return $teamPower->defense * $this->calculateStrengthModifier($teamPower);
    }
}
