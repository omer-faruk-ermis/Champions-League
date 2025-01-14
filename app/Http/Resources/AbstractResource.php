<?php

namespace App\Http\Resources;

use App\Traits\ResourceableTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract class AbstractResource
 *
 * @package App\Http\Resources
 */
abstract class AbstractResource extends JsonResource
{
    use ResourceableTrait;

    /**
     * AbstractResource constructor.
     *
     * @param mixed        $resource
     * @param string|null  $message
     * @param int          $statusCode
     */
    public function __construct($resource, ?string $message = null, int $statusCode = Response::HTTP_OK)
    {
        parent::__construct($resource);

        $this->message = $message;
        $this->statusCode = $statusCode;
    }
}
