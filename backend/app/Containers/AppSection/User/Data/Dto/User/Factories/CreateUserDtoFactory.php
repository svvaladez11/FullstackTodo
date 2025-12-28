<?php

namespace App\Containers\AppSection\User\Data\Dto\User\Factories;

use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Containers\AppSection\User\Models\User;

/**
 * @phpstan-import-type Image from User
 * @phpstan-type DataArray array{
 *      id: ?string,
 *      login: ?string,
 *      created_at: ?string,
 *      updated_at: ?string,
 *      deleted_at: ?string,
 *  }
 */
final class CreateUserDtoFactory
{
    public function fromModel(User $model): UserDto
    {
        /** @phpstan-var DataArray $data */
        $data = $model->toArray();
        return $this->fromArray($data);
    }

    /**
     * @phpstan-param DataArray $data
     * @phpstan-return UserDto
     */
    public function fromArray(array $data): UserDto
    {
        return new UserDto(...$data);
    }
}
