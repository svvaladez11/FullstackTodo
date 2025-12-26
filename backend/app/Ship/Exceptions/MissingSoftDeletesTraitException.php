<?php

namespace App\Ship\Exceptions;

use Exception;

class MissingSoftDeletesTraitException extends Exception
{
    /**
     * @var string $message
     */
    protected $message = 'The model does not use the SoftDeletes trait but tried to call withTrashed method.';
}
