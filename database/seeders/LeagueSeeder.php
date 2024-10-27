<?php

namespace Database\Seeders;

use App\Constants\LeagueStatus;
use App\Models\League;
use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        League::create([
                           'name'          => 'Champions League',
                           'total_matches' => 14,
                           'league_status' => LeagueStatus::PASSIVE,
                       ]);

        League::create([
                           'name'          => 'Serie A',
                           'total_matches' => 6,
                           'league_status' => LeagueStatus::PASSIVE,
                       ]);

        League::create([
                           'name'          => 'Premier League',
                           'total_matches' => 6,
                           'league_status' => LeagueStatus::PASSIVE,
                       ]);
    }
}
