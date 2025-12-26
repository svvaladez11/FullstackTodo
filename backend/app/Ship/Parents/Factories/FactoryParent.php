<?php

namespace App\Ship\Parents\Factories;

use App\Ship\Core\Abstracts\Factories\FactoryCore;
use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Models\AuthenticatableCore;

/**
 * @phpstan-template TModel of ModelCore|AuthenticatableCore
 * @phpstan-extends FactoryCore<TModel>
 */
abstract class FactoryParent extends FactoryCore
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        // TODO: Implement definition() method.
    }
}
