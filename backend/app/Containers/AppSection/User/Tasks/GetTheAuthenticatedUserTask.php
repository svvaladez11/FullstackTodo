<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Contracts\Tasks\GetTheAuthenticatedUserTaskContract;
use App\Containers\AppSection\User\Contracts\Data\Presenters\UserPresenterContract;
use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\UnauthorizedException;
use App\Ship\Parents\Tasks\TaskParent;
use Illuminate\Support\Facades\Auth;

final class GetTheAuthenticatedUserTask extends TaskParent implements GetTheAuthenticatedUserTaskContract
{
    public function __construct(
        private readonly UserPresenterContract $presenter,
    ) {
    }

    public function run(): UserDto
    {
        /** @psalm-var User|null $model */
        $model = Auth::user();
        return $model
            ? $this->presenter->present($model)
            : throw new UnauthorizedException();
    }
}
