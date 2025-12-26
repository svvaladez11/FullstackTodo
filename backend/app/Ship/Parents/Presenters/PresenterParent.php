<?php

namespace App\Ship\Parents\Presenters;

use App\Ship\Core\Abstracts\Presenters\PresenterCore;
use App\Ship\Parents\Dto\DtoParent;
use App\Ship\Parents\Models\AuthenticatableParent as Authenticatable;
use App\Ship\Parents\Models\ModelParent as Model;

/**
 * @phpstan-template TModel of Model|Authenticatable
 * @phpstan-template TDto of DtoParent
 * @phpstan-extends PresenterCore<TModel, TDto>
 */
abstract class PresenterParent extends PresenterCore
{
}
