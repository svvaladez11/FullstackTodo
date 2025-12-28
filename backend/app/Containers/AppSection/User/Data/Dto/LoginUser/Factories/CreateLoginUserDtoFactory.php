<?php

namespace App\Containers\AppSection\User\Data\Dto\LoginUser\Factories;

use App\Containers\AppSection\User\Data\Dto\LoginUser\LoginUserDto;
use App\Containers\AppSection\User\UI\API\Requests\LoginUserRequest;

/**
 * @phpstan-type DataArray array{
 *     login: non-empty-string,
 *     password: non-empty-string,
 * }
 */
final class CreateLoginUserDtoFactory
{
    public function fromRequest(LoginUserRequest $request): LoginUserDto
    {
        /** @phpstan-var DataArray $data */
        $data = $request->validated();
        return $this->fromArray($data);
    }

    /**
     * @phpstan-param DataArray $data
     * @phpstan-return LoginUserDto
     */
    public function fromArray(array $data): LoginUserDto
    {
        return new LoginUserDto(...$data);
    }
}
