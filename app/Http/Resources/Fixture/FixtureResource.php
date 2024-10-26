<?php

namespace App\Http\Resources\Fixture;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\League\LeagueResource;
use App\Http\Resources\Team\TeamResource;

/**
 * Class FixtureResource
 *
 * @package App\Http\Resources\Fixture
 *
 * @mixin mixed
 */
class FixtureResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'              => $this->getKey(),
            'match_date'      => $this->match_date,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
            'home_team'       => TeamResource::make($this->whenLoaded('homeTeam')),
            'away_team'       => TeamResource::make($this->whenLoaded('awayTeam')),
            'league'          => LeagueResource::collection($this->whenLoaded('league')),
        ];
    }
}