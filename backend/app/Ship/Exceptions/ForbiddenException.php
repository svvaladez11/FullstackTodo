<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_FORBIDDEN;

    /**
     * @var string $message
     */
    protected $message = 'Request could not be satisfied due to insufficient permissions.'; // maybe change later
}
