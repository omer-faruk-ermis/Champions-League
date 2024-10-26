<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\AbstractCollection;

/**
 * Class TeamCollection
 *
 * @package App\Http\Resources\Team
 *
 * @mixin mixed
 */
class TeamCollection extends AbstractCollection
{
    public $collects = TeamResource::class;

    /**
     * @inheritDoc
     */
    public function toArray($request): object
    {
        return $this->collection;
    }
}
