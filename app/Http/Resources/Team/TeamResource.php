<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\League\LeagueResource;
use App\Http\Resources\Standing\StandingResource;

/**
 * Class TeamResource
 *
 * @package App\Http\Resources\Team
 *
 * @mixin mixed
 */
class TeamResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->getKey(),
            'name'     => $this->name,
            'country'  => $this->country,
            'power'    => TeamPowerResource::make($this->whenLoaded('power')),
            'leagues'  => LeagueResource::collection($this->whenLoaded('leagues')),
            'standing' => StandingResource::make($this->whenLoaded('standing')),
        ];
    }
}
