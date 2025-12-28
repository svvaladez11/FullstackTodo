<?php

namespace App\Containers\AppSection\User\Data\Presenters;

use App\Containers\AppSection\User\Contracts\Data\Presenters\UserPresenterContract;
use App\Containers\AppSection\User\Data\Dto\User\Factories\
{
    CreateUserDtoFactory
};
use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Core\Abstracts\Models\AuthenticatableCore as Authenticatable;
use App\Ship\Core\Abstracts\Models\ModelCore as Model;
use App\Ship\Parents\Presenters\PresenterParent;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * @phpstan-extends PresenterParent<User, UserDto>
 */
final class UserPresenter extends PresenterParent implements UserPresenterContract
{
    public function __construct(
        private readonly CreateUserDtoFactory $createUserDtoFactory,
    ) {
    }

    public function present(Authenticatable|Model $model): UserDto
    {
        /** @phpstan-var User $model */
        return $this->createUserDtoFactory->fromModel($model);
    }

    public function presentCollection(EloquentCollection $collection): Collection
    {
        $collection->toArray();
        /** @phpstan-var Collection<int, User> $collection */
        return $collection->map(
        /**
         * @phpstan-param User $model
         * @phpstan-return UserDto
         */
            fn($model) => $this->present($model)
        );
    }
}
