<?php

namespace App\Filters\Fixture;

class LeagueId
{
    public function apply($query, $value): void
    {
        $query->where('league_id', $value);
    }
}
