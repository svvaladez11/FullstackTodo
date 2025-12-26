<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AlreadyExistsException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_CONFLICT;

    /**
     * @var string $message
     */
    protected $message = 'The record already exists.';
}
