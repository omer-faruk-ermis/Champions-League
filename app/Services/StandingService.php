<?php

namespace App\Services;

use App\Models\Standing;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class StandingService
 *
 * @package App\Services
 */
class StandingService
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Standing::with([
                                  'team',
                                  'league',
                              ])
            ->whereNull('deleted_at')
            ->get();
    }
}
