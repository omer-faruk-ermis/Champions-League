<?php

namespace App\Models\Team;

use App\Models\AbstractModel;

/**
 * Class TeamPower
 *
 * @package App\Models\Team
 *
 * @property int $id
 * @property int $team_id
 * @property int $fan_support
 * @property int $team_spirit
 * @property int $attack
 * @property int $defense
 *
 */
class TeamPower extends AbstractModel
{
    protected $table    = 'champions_league.team_powers';
    protected $fillable = [
        'team_id',
        'fan_support',
        'team_spirit',
        'attack',
        'defense',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($team) {
            if ($team->fan_support < 20) {
                $team->fan_support = 20;
            }
            if ($team->team_spirit < 20) {
                $team->team_spirit = 20;
            }
        });
    }
}
