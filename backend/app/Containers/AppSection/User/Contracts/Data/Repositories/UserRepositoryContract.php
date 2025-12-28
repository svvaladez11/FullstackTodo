<?php

namespace App\Containers\AppSection\User\Contracts\Data\Repositories;

use App\Containers\AppSection\User\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * @phpstan-import-type Image from User
 * @phpstan-type Fillable array{
 *     first_name?: string,
 *     last_name?: string,
 *     middle_name?: string,
 *     login?: string,
 *     avatar?: Image,
 *     role?: int,
 *     password?: string,
 *     created_at?: Carbon,
 *     updated_at?: Carbon,
 * }
 */
interface UserRepositoryContract
{
    /**
     * @param int|null $limit
     * @param string[] $select
     * @param int $page
     * @return Collection<int, User>
     */
    public function paginate(?int $limit = null, array $select = ['*'], int $page = 1): Collection;

    /**
     * @param string $field
     * @param mixed $value
     * @param string[] $select
     * @return User|null
     */
    public function findByField(string $field, mixed $value, array $select = ['*']): ?User;
}
