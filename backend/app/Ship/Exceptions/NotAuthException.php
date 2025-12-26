<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotAuthException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_UNAUTHORIZED;

    /**
     * @var string $message
     */
    protected $message = 'The user is not authorized.';
}
