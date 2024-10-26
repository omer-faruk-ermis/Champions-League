<?php

namespace App\Models\Team;

use App\Models\AbstractModel;
use App\Models\League;
use App\Models\Standing;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
}
