<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class FailedToDeleteFileException extends Exception
{
    /** @phpstan-var int $code */
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    /** @phpstan-var string $message */
    protected $message = 'Failed to delete file.';
}
