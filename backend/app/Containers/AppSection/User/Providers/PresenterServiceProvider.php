<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Contracts\Data\Presenters\UserPresenterContract;
use App\Containers\AppSection\User\Data\Presenters\UserPresenter;
use App\Ship\Parents\Providers\ServiceProviderParent;
use Override;

final class PresenterServiceProvider extends ServiceProviderParent
{
    /**
     * @phpstan-return void
     */
    #[Override]
    public function register(): void
    {
        parent::register();
        $this->app->bind(
            UserPresenterContract::class,
            UserPresenter::class,
        );
    }
}
