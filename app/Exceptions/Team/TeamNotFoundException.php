<?php

namespace App\Exceptions\Team;

use App\Exceptions\AbstractException;
use Illuminate\Http\Response;

class TeamNotFoundException extends AbstractException
{
    protected $code = Response::HTTP_NOT_FOUND;
}
