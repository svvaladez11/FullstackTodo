<?php

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Containers\AppSection\User\Contracts\Data\Repositories\UserRepositoryContract;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Repositories\RepositoryParent;
use Override;

/**
 * @phpstan-extends RepositoryParent<User>
 */
final class UserRepository extends RepositoryParent implements UserRepositoryContract
{
    protected function getModelClass(): string
    {
        return User::class;
    }

    #[Override]
    public function findByField(string $field, mixed $value, array $select = ['*']): User|null
    {
        return parent::findByField($field, $value, $select);
    }
}
