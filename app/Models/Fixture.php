<?php

namespace App\Models;

use App\Filters\Fixture\FixtureFilter;
use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Match
 *
 * @package App\Models\Match
 *
 * @property int         $id
 * @property int         $home_team_id
 * @property int         $away_team_id
 * @property int         $league_id
 * @property int         $match_order
 * @property int         $home_team_score
 * @property int         $away_team_score
 * @property string      $match_status
 *
 * @property-read Team   $homeTeam
 * @property-read Team   $awayTeam
 * @property-read League $league
 */
class Fixture extends AbstractModel
{
    protected $table    = 'champions_league.fixtures';
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'league_id',
        'match_order',
        'home_team_score',
        'away_team_score',
        'match_status',
    ];

    /**
     * @return BelongsTo
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * @return BelongsTo
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    /**
     * @return hasOne
     */
    public function league(): hasOne
    {
        return $this->hasOne(League::class, 'id', 'league_id');
    }

    /**
     * @param $filters
     *
     * @return FixtureFilter
     */
    protected function filter($filters): FixtureFilter
    {
        return new FixtureFilter($filters);
    }
}
