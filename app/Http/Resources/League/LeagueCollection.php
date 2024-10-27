<?php

namespace App\Http\Resources\League;

use App\Http\Resources\AbstractCollection;

/**
 * Class LeagueCollection
 *
 * @package App\Http\Resources\League
 *
 * @mixin mixed
 */
class LeagueCollection extends AbstractCollection
{
    public $collects = LeagueResource::class;

    /**
     * @inheritDoc
     */
    public function toArray($request): object
    {
        return $this->collection;
    }
}
