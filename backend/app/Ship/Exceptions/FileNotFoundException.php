<?php

namespace App\Ship\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class FileNotFoundException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = Response::HTTP_NOT_FOUND;

    /**
     * @var string $message
     */
    protected $message = 'The file could not be found.';
}
