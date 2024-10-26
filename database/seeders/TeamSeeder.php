<?php

namespace Database\Seeders;

use App\Models\Team\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Juventus',
                'country' => 'Italy',
            ],
            [
                'name' => 'Inter',
                'country' => 'Italy',
            ],
            [
                'name' => 'Lazio',
                'country' => 'Italy',
            ],
            [
                'name' => 'Parma',
                'country' => 'Italy',
            ],

            [
                'name' => 'Aston Villa',
                'country' => 'England',
            ],
            [
                'name' => 'Everton',
                'country' => 'England',
            ],
            [
                'name' => 'Manchester City',
                'country' => 'England',
            ],
            [
                'name' => 'Manchester United',
                'country' => 'England',
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
