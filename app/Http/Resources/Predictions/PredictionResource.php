<?php

namespace App\Http\Resources\Predictions;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\League\LeagueResource;
use App\Http\Resources\Team\TeamResource;

/**
 * Class PredictionResource
 *
 * @package App\Http\Resources\Prediction
 *
 * @mixin mixed
 */
class PredictionResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                       => $this->getKey(),
            'championship_probability' => $this->championshipProbability,
            'team'                     => TeamResource::make($this->whenLoaded('team')),
            'league'                   => LeagueResource::make($this->whenLoaded('league')),
        ];
    }
}
