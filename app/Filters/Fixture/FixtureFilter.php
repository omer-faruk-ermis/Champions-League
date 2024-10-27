<?php

namespace App\Filters\Fixture;

use App\Filters\AbstractFilter;

class FixtureFilter extends AbstractFilter
{
    protected function defineFilters(): array
    {
        return [
            'league_id' => LeagueId::class,
        ];
    }
}
