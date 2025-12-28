<?php

namespace App\Containers\AppSection\User\Contracts\Actions;

use App\Ship\Core\Abstracts\Actions\ActionCore;

/**
 * @psalm-import-type Response from ActionCore
 */
interface LogoutUserActionContract
{
    /**
     * @phpstan-return Response
     */
    public function __invoke(): array;
}
