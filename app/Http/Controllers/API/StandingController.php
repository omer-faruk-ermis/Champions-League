<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Standing\StandingCollection;
use App\Services\StandingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class StandingController
 *
 * @package App\Http\Controllers\API
 */
class StandingController extends Controller
{
    /** @var StandingService $standingService */
    private StandingService $standingService;

    /**
     * StandingController constructor
     */
    public function __construct()
    {
        $this->standingService = new StandingService();
    }

    /**
     * @param Request $request
     *
     * @return StandingCollection
     */
    public function index(Request $request): StandingCollection
    {
        $standings = $this->standingService->index($request);

        return new StandingCollection($standings, __('messages.' . self::class . '.INDEX'));
    }
}
