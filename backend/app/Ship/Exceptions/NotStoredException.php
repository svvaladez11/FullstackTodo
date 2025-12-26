<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotStoredException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var string $message
     */
    protected $message = 'The video could not be stored.';
}
