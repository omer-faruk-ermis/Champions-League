<?php

namespace App\Http\Resources\League;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\Team\TeamResource;

/**
 * Class LeagueResource
 *
 * @package App\Http\Resources\League
 *
 * @mixin mixed
 */
class LeagueResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'    => $this->getKey(),
            'name'  => $this->name,
            'teams' => TeamResource::collection($this->whenLoaded('teams')),
        ];
    }
}
