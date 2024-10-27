<?php

namespace App\Filters\Standing;

use App\Filters\AbstractFilter;

class StandingFilter extends AbstractFilter
{
    protected function defineFilters(): array
    {
        return [
            'league_id' => LeagueId::class,
        ];
    }
}
