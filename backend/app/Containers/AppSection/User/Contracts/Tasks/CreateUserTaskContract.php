<?php

namespace App\Containers\AppSection\User\Contracts\Tasks;

use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Ship\Exceptions\InternalServerErrorException;

/**
 * @phpstan-import-type DtoArray from RegisterUserDto
 */
interface CreateUserTaskContract
{
    /**
     * @phpstan-param RegisterUserDto $user
     * @phpstan-return UserDto
     * @throws InternalServerErrorException
     */
    public function run(RegisterUserDto $user): UserDto;
}
