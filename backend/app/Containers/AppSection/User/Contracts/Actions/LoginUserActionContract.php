<?php

namespace App\Containers\AppSection\User\Contracts\Actions;

use App\Containers\AppSection\User\Data\Dto\LoginUser\LoginUserDto;
use App\Ship\Core\Abstracts\Actions\ActionCore;

/**
 * @psalm-import-type Response from ActionCore
 */
interface LoginUserActionContract
{
    /**
     * @phpstan-param LoginUserDto $dto
     * @phpstan-return Response
     */
    public function __invoke(LoginUserDto $dto): array;
}
