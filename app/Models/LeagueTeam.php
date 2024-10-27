<?php

namespace App\Models;

/**
 * Class LeagueTeam
 *
 * @package App\Models
 *
 * @property int       $id
 * @property int       $league_id
 * @property int       $team_id
 *
 */
class LeagueTeam extends AbstractModel
{
    protected $table    = 'champions_league.league_team';
    protected $fillable = [
        'league_id',
        'team_id',
    ];
}
