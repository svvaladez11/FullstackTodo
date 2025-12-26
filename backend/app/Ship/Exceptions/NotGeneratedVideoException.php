<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotGeneratedVideoException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var string $message
     */
    protected $message = 'The hls video could not be generated.';
}
