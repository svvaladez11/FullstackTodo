<?php

namespace App\Containers\AppSection\User\Contracts\Actions;

use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Ship\Core\Abstracts\Actions\ActionCore;

/**
 * @psalm-import-type Response from ActionCore
 */
interface RegisterUserActionContract
{
    /**
     * @phpstan-param RegisterUserDto $dto
     * @phpstan-return Response
     */
    public function __invoke(RegisterUserDto $request): array;
}
