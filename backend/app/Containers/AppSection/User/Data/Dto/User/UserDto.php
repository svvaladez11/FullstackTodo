<?php

namespace App\Containers\AppSection\User\Data\Dto\User;

use App\Ship\Parents\Dto\DtoParent;

/**
 * @phpstan-type DtoArray array{
 *     id?: string,
 *     login?: string,
 *     created_at?: string,
 *     updated_at?: string,
 *     deleted_at?: string,
 * }
 * @phpstan-extends DtoParent<DtoArray>
 */
final readonly class UserDto extends DtoParent
{
    /**
     * @phpstan-param string|null $id
     * @phpstan-param string|null $login
     * @phpstan-param string|null $created_at
     * @phpstan-param string|null $updated_at
     * @phpstan-param string|null $deleted_at
     */
    public function __construct(
        public ?string $id = null,
        public ?string $login = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null,
    ) {
    }
}
