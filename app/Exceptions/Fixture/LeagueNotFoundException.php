<?php

namespace App\Exceptions\Fixture;

use App\Exceptions\AbstractException;
use Illuminate\Http\Response;

class LeagueNotFoundException extends AbstractException
{
    protected $code = Response::HTTP_NOT_FOUND;
}
