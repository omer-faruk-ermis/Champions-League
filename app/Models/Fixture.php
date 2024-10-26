<?php

namespace App\Models;

use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Match
 *
 * @package App\Models\Match
 *
 * @property int         $id
 * @property int         $home_team_id
 * @property int         $away_team_id
 * @property int         $league_id
 * @property Carbon      $match_date
 * @property int         $home_team_score
 * @property int         $away_team_score
 *
 * @property-read Team   $homeTeam
 * @property-read Team   $awayTeam
 * @property-read League $league
 */
class Fixture extends AbstractModel
{
    protected $table    = 'champions_league.fixture';
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'league_id',
        'match_date',
        'home_team_score',
        'away_team_score',
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
     * @return BelongsTo
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }
}
