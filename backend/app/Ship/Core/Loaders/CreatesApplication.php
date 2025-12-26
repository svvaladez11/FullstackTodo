<?php

namespace App\Ship\Core\Loaders;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     * @throws BindingResolutionException
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../../../../bootstrap/app.php';
        /** @phpstan-var Application $app */

        $app->make(Kernel::class)
            ->bootstrap();

        return $app;
    }
}
