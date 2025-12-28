<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Actions\GetTheAuthenticatedUserAction;
use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\Actions\CreateUserAction;
use App\Containers\AppSection\User\Actions\LoginUserAction;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Actions\ShowUserAction;
use App\Containers\AppSection\User\Actions\EditUserAction;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Actions\DestroyUserAction;
use App\Containers\AppSection\User\Contracts\Actions\GetTheAuthenticatedUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\ListUsersActionContract;
use App\Containers\AppSection\User\Contracts\Actions\CreateUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\LoginUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\RegisterUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\ShowUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\EditUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\UpdateUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\DestroyUserActionContract;
use App\Ship\Parents\Providers\ServiceProviderParent;
use Override;

final class ActionServiceProvider extends ServiceProviderParent
{
    /**
     * @phpstan-return void
     */
    #[Override]
    public function register(): void
    {
        parent::register();
        $this->app->bind(
            RegisterUserActionContract::class,
            RegisterUserAction::class,
        );
        $this->app->bind(
            LoginUserActionContract::class,
            LoginUserAction::class,
        );
        $this->app->bind(
            GetTheAuthenticatedUserActionContract::class,
            GetTheAuthenticatedUserAction::class,
        );
    }
}
