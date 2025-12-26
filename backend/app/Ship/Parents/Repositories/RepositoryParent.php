<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use App\Ship\Parents\Models\ModelParent;

/**
 * @phpstan-template TModel of ModelParent
 * @phpstan-extends RepositoryCore<TModel>
 */
abstract class RepositoryParent extends RepositoryCore
{
}
