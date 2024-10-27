<?php

namespace App\Filters\Team;

class LeagueId
{
    public function apply($query, $value): void
    {
        $query->whereHas('leagues', function ($q) use ($value) {
            $q->where('leagues.id', $value);
        });
    }
}
