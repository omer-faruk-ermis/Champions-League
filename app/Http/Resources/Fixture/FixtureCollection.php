<?php

namespace App\Http\Resources\Fixture;

use App\Http\Resources\AbstractCollection;

/**
 * Class FixtureCollection
 *
 * @package App\Http\Resources\Fixture
 *
 * @mixin mixed
 */
class FixtureCollection extends AbstractCollection
{
    public $collects = FixtureResource::class;

    /**
     * @inheritDoc
     */
    public function toArray($request): object
    {
        return $this->collection;
    }
}
