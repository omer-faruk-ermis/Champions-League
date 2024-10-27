<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Predictions\PredictionCollection;
use App\Services\PredictionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PredictionController
 *
 * @package App\Http\Controllers\API
 */
class PredictionController extends Controller
{
    /** @var PredictionService $predictionService */
    private PredictionService $predictionService;

    /**
     * PredictionController constructor
     */
    public function __construct()
    {
        $this->predictionService = new PredictionService();
    }

    /**
     * @param Request $request
     *
     * @return PredictionCollection
     */
    public function index(Request $request): PredictionCollection
    {
        $predictions = $this->predictionService->index($request);

        return new PredictionCollection($predictions, __('messages.' . self::class . '.INDEX'));
    }
}
