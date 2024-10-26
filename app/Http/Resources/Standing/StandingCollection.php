<?php

namespace App\Http\Resources\Standing;

use App\Http\Resources\AbstractCollection;

/**
 * Class StandingCollection
 *
 * @package App\Http\Resources\Standing
 *
 * @mixin mixed
 */
class StandingCollection extends AbstractCollection
{
    public $collects = StandingResource::class;

    /**
     * @inheritDoc
     */
    public function toArray($request): object
    {
        return $this->collection;
    }
}
