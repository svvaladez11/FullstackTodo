<?php

namespace App\Ship\Core\Abstracts\Factories;

use App\Ship\Core\Abstracts\Models\AuthenticatableCore;
use App\Ship\Core\Abstracts\Models\ModelCore;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @phpstan-template TModel of ModelCore|AuthenticatableCore
 * @phpstan-extends Factory<TModel>
 */
abstract class FactoryCore extends Factory
{
}
