<?php

namespace App\Containers\AppSection\User\Data\Dto\RegisterUser;

use App\Ship\Parents\Dto\DtoParent;
use Illuminate\Http\UploadedFile;

/**
 * @phpstan-type DtoArray array{
 *     login: non-empty-string,
 *     password: non-empty-string,
 *     password_confirm: non-empty-string,
 * }
 * @phpstan-extends DtoParent<DtoArray>
 */
final readonly class RegisterUserDto extends DtoParent
{
    /**
     * @phpstan-param non-empty-string $login
     * @phpstan-param non-empty-string $password
     * @phpstan-param non-empty-string $password_confirm
     */
    public function __construct(
        public string $login,
        public string $password,
        public string $password_confirm,
    ) {
    }
}
