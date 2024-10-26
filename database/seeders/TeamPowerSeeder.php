<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamPowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamPowers = [
            [
                'team_id' => 1,
                'attack' => 78,
                'defense' => 85,
                'team_spirit' => 11,
                'fan_support' => 16,
            ],
            [
                'team_id' => 2,
                'attack' => 82,
                'defense' => 80,
                'team_spirit' => 18,
                'fan_support' => 20,
            ],
            [
                'team_id' => 3,
                'attack' => 75,
                'defense' => 63,
                'team_spirit' => 20,
                'fan_support' => 20,
            ],
            [
                'team_id' => 4,
                'attack' => 65,
                'defense' => 60,
                'team_spirit' => 7,
                'fan_support' => 3,
            ],

            [
                'team_id' => 5,
                'attack' => 77,
                'defense' => 80,
                'team_spirit' => 12,
                'fan_support' => 10,
            ],
            [
                'team_id' => 6,
                'attack' => 73,
                'defense' => 75,
                'team_spirit' => 16,
                'fan_support' => 9,
            ],
            [
                'team_id' => 7,
                'attack' => 93,
                'defense' => 88,
                'team_spirit' => 20,
                'fan_support' => 20,
            ],
            [
                'team_id' => 8,
                'attack' => 84,
                'defense' => 81,
                'team_spirit' => 5,
                'fan_support' => 14,
            ],
        ];

        foreach ($teamPowers as $teamPower) {
            TeamPower::create($teamPower);
        }
    }
}
