<?php

namespace App\Services;

use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class LeagueService
 *
 * @package App\Services
 */
class LeagueService
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return League::with(['teams'])
            ->whereNull('deleted_at')
            ->get();
    }
}
