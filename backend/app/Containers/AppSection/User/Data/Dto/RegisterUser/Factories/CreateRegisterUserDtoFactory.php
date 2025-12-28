<?php

namespace App\Containers\AppSection\User\Data\Dto\RegisterUser\Factories;

use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;

/**
 * @phpstan-type DataArray array{
 *     login: non-empty-string,
 *     password: non-empty-string,
 *     password_confirm: non-empty-string,
 * }
 */
final class CreateRegisterUserDtoFactory
{
    public function fromRequest(RegisterUserRequest $request): RegisterUserDto
    {
        /** @phpstan-var DataArray $data */
        $data = $request->validated();
        return $this->fromArray($data);
    }

    /**
     * @phpstan-param DataArray $data
     * @phpstan-return RegisterUserDto
     */
    public function fromArray(array $data): RegisterUserDto
    {
        return new RegisterUserDto(...$data);
    }
}
