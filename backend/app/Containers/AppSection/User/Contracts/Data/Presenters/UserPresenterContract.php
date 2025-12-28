<?php

namespace App\Containers\AppSection\User\Contracts\Data\Presenters;

use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface UserPresenterContract
{
    /**
     * @phpstan-param EloquentCollection<int, User> $collection
     * @phpstan-return Collection<int, UserDto>
     */
    public function presentCollection(EloquentCollection $collection): Collection;

    /**
     * @phpstan-param User $model
     * @phpstan-return UserDto
     */
    public function present(User $model): UserDto;
}
