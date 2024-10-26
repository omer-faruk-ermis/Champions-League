<?php


use App\Http\Controllers\API\FixtureController;
use App\Http\Controllers\API\StandingController;
use App\Http\Controllers\API\TeamController;

return [

    TeamController::class => [
        'INDEX' => 'Team List',
        'SHOW'  => 'Team Detail',
    ],

    StandingController::class => [
        'INDEX' => 'Standing List',
    ],

    FixtureController::class => [
        'INDEX'             => 'Fixture List',
        'SHOW'              => 'Match Detail',
        'UPDATE'            => 'Edited Match Scores',
        'CREATE_FIXTURE'    => 'Created all season fixture',
        'PLAY_WEEK_MATCHES' => 'Playing week matches',
    ],

];
