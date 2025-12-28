<?php

namespace App\Containers\AppSection\User\Contracts\Actions;

use App\Containers\AppSection\User\Data\Dto\LoginUser\LoginUserDto;
use App\Ship\Core\Abstracts\Actions\ActionCore;

interface RespondWithTokenSubActionContract
{
    /**
     * @phpstan-param string $token
     * @phpstan-return array{
     *     access_token: string,
     *     token_type: "bearer",
     *     expires_in: positive-int,
     * }
     */
    public function run(string $token): array;
}
