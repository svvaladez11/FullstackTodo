<?php

namespace App\Containers\AppSection\User\Data\Dto\LoginUser;

use App\Ship\Parents\Dto\DtoParent;
use Illuminate\Http\UploadedFile;

/**
 * @phpstan-type DtoArray array{
 *     login: non-empty-string,
 *     password: non-empty-string,
 * }
 * @phpstan-extends DtoParent<DtoArray>
 */
final readonly class LoginUserDto extends DtoParent
{
    /**
     * @phpstan-param non-empty-string $login
     * @phpstan-param non-empty-string $password
     */
    public function __construct(
        public string $login,
        public string $password,
    ) {
    }
}
