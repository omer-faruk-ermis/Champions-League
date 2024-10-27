<?php

namespace App\Filters\Team;

use App\Filters\AbstractFilter;

class TeamFilter extends AbstractFilter
{
    protected function defineFilters(): array
    {
        return [
            'league_id' => LeagueId::class,
        ];
    }
}
