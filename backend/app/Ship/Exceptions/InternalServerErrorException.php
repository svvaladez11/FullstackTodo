<?php

namespace App\Ship\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorException extends \Exception
{
    /** @phpstan-var int $code */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    /** @phpstan-var string $message */
    protected $message = 'Something went wrong. Please try again later.';
}
