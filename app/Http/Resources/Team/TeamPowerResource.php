<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\AbstractResource;

/**
 * Class TeamResource
 *
 * @package App\Http\Resources\Team
 *
 * @mixin mixed
 */
class TeamPowerResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->getKey(),
            'attack'      => $this->attack,
            'defense'     => $this->defense,
            'team_spirit' => $this->team_spirit,
            'fan_support' => $this->fan_support,
        ];
    }
}
