<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Fixture\FixtureNotFoundException;
use App\Http\Resources\Fixture\FixtureCollection;
use App\Http\Resources\Fixture\FixtureResource;
use App\Http\Resources\SuccessResource;
use App\Services\FixtureService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FixtureController
 *
 * @package App\Http\Controllers\API
 */
class FixtureController extends Controller
{
    /** @var FixtureService $fixtureService */
    private FixtureService $fixtureService;

    /**
     * FixtureController constructor
     */
    public function __construct()
    {
        $this->fixtureService = new FixtureService();
    }

    /**
     * @param Request $request
     *
     * @return FixtureCollection
     */
    public function index(Request $request): FixtureCollection
    {
        $fixtures = $this->fixtureService->index($request);

        return new FixtureCollection($fixtures, __('messages.' . self::class . '.INDEX'));
    }

    /**
     * @param int $id
     *
     * @return FixtureResource
     * @throws FixtureNotFoundException
     */
    public function show(int $id): FixtureResource
    {
        $fixture = $this->fixtureService->show($id);

        return new FixtureResource($fixture, __('messages.' . self::class . '.SHOW'));
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return FixtureResource
     * @throws FixtureNotFoundException
     */
    public function update(Request $request, int $id): FixtureResource
    {
        $fixture = $this->fixtureService->update($request, $id);

        return new FixtureResource($fixture, __('messages.' . self::class . '.UPDATE'));
    }

    /**
     * @param Request $request
     *
     * @return SuccessResource
     */
    public function createFixture(Request $request): SuccessResource
    {
        $this->fixtureService->createFixture($request);

        return new SuccessResource(__('messages.' . self::class . '.CREATE_FIXTURE'));
    }

    /**
     * @param Request $request
     *
     * @return SuccessResource
     */
    public function playWeekMatches(Request $request): SuccessResource
    {
        $this->fixtureService->playWeekMatches($request);

        return new SuccessResource(__('messages.' . self::class . '.PLAY_WEEK_MATCHES'));
    }
}
