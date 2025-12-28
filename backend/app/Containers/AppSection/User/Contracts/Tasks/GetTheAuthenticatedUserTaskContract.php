<?php

namespace App\Containers\AppSection\User\Contracts\Tasks;

use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Ship\Exceptions\UnauthorizedException;

interface GetTheAuthenticatedUserTaskContract
{
    /**
     * @phpstan-return UserDto
     * @throws UnauthorizedException
     */
    public function run(): UserDto;
}
