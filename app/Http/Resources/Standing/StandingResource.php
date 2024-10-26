<?php

namespace App\Http\Resources\Standing;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\League\LeagueResource;
use App\Http\Resources\Team\TeamResource;

/**
 * Class StandingResource
 *
 * @package App\Http\Resources\League
 *
 * @mixin mixed
 */
class StandingResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->getKey(),
            'played'        => $this->played,
            'won'           => $this->won,
            'drawn'         => $this->drawn,
            'lost'          => $this->lost,
            'goals_for'     => $this->goals_for,
            'goals_against' => $this->goals_against,
            'points'        => $this->points,
            'team'          => TeamResource::make($this->whenLoaded('team')),
            'league'        => LeagueResource::make($this->whenLoaded('league')),
        ];
    }
}
