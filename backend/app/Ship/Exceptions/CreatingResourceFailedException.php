<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CreatingResourceFailedException extends Exception
{
    /** @var int $code */
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    /**
     * @var string $message
     */
    protected $message = 'Failed to creating Resource.';
}
