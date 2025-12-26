<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UpdatingResourceFailedException extends Exception
{
    /** @var int $code */
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    /**
     * @var string $message
     */
    protected $message = 'Updating resource is failed.';
}
