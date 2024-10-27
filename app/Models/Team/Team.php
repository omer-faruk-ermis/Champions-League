<?php

namespace App\Models\Team;

use App\Filters\Team\TeamFilter;
use App\Models\AbstractModel;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Standing;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Team
 *
 * @package App\Models\Team
 *
 * @property int            $id
 * @property string         $name
 * @property string         $country
 *
 * @property-read League    $leagues
 * @property-read TeamPower $power
 * @property-read Standing  $standing
 * @property-read Fixture   $homeFixtures
 * @property-read Fixture   $awayFixtures
 */
class Team extends AbstractModel
{
    protected $table    = 'champions_league.teams';
    protected $fillable = [
        'name',
        'country',
    ];

    /**
     * @return BelongsToMany
     */
    public function leagues(): BelongsToMany
    {
        return $this->belongsToMany(League::class);
    }

    /**
     * @return hasOne
     */
    public function power(): hasOne
    {
        return $this->hasOne(TeamPower::class, 'team_id', 'id');
    }

    /**
     * @return hasOne
     */
    public function standing(): hasOne
    {
        return $this->hasOne(Standing::class, 'team_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function homeFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'home_team_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function awayFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'away_team_id', 'id');
    }

    /**
     * @param $filters
     *
     * @return TeamFilter
     */
    protected function filter($filters): TeamFilter
    {
        return new TeamFilter($filters);
    }
}
