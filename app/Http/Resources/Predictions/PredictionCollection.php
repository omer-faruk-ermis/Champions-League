<?php

namespace App\Http\Resources\Predictions;

use App\Http\Resources\AbstractCollection;

/**
 * Class PredictionCollection
 *
 * @package App\Http\Resources\Predictions
 *
 * @mixin mixed
 */
class PredictionCollection extends AbstractCollection
{
    public $collects = PredictionResource::class;

    /**
     * @inheritDoc
     */
    public function toArray($request): object
    {
        return $this->collection;
    }
}
