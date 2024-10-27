<?php

namespace App\Models;

use App\Filters\Standing\StandingFilter;
use App\Filters\Team\TeamFilter;
use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Standing
 *
 * @package App\Models
 *
 * @property int         $id
 * @property int         $team_id
 * @property int         $league_id
 * @property int         $played
 * @property int         $won
 * @property int         $drawn
 * @property int         $lost
 * @property int         $goals_for
 * @property int         $goals_against
 * @property int         $points
 *
 * @property-read Team   $team
 * @property-read League $league
 */
class Standing extends AbstractModel
{
    protected $table    = 'champions_league.standings';
    protected $fillable = [
        'team_id',
        'league_id',
        'played',
        'won',
        'drawn',
        'lost',
        'goals_for',
        'goals_against',
        'points',
    ];

    /**
     * @return BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return BelongsTo
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    /**
     * @return void
     */
    public function calculatePoints(): void
    {
        $this->points = ($this->won * 3) + $this->drawn;
        $this->save();
    }

    /**
     * @param $filters
     *
     * @return StandingFilter
     */
    protected function filter($filters): StandingFilter
    {
        return new StandingFilter($filters);
    }
}
