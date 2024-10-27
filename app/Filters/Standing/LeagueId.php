<?php

namespace App\Filters\Standing;

class LeagueId
{
    public function apply($query, $value): void
    {
        $query->where('league_id', $value);
    }
}
