<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Contracts\Tasks\GetListUsersTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\GetTheAuthenticatedUserTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\GetUserRolesTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\CreateUserTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\FindUserByIdTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\LoginUserTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\UpdateUserTaskContract;
use App\Containers\AppSection\User\Contracts\Tasks\DestroyUserTaskContract;
use App\Containers\AppSection\User\Tasks\GetListUsersTask;
use App\Containers\AppSection\User\Tasks\GetTheAuthenticatedUserTask;
use App\Containers\AppSection\User\Tasks\GetUserRolesTask;
use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\Tasks\LoginUserTask;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tasks\DestroyUserTask;
use App\Ship\Parents\Providers\ServiceProviderParent;
use Override;

final class TaskServiceProvider extends ServiceProviderParent
{
    /**
     * @phpstan-return void
     */
    #[Override]
    public function register(): void
    {
        parent::register();
        $this->app->bind(
            CreateUserTaskContract::class,
            CreateUserTask::class,
        );
        $this->app->bind(
            GetTheAuthenticatedUserTaskContract::class,
            GetTheAuthenticatedUserTask::class,
        );
    }
}
