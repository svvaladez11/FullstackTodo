<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Contracts\Data\Repositories\UserRepositoryContract;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Providers\ServiceProviderParent;
use Override;

final class RepositoryServiceProvider extends ServiceProviderParent
{
    /**
     * @phpstan-return void
     */
    #[Override]
    public function register(): void
    {
        parent::register();
        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class,
        );
    }
}
