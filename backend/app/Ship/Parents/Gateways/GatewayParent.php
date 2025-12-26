<?php

namespace App\Ship\Parents\Gateways;

use App\Ship\Core\Abstracts\Gateways\GatewayCore;
use App\Ship\Parents\Dto\DtoParent;
use App\Ship\Parents\Models\AuthenticatableParent;
use App\Ship\Parents\Models\ModelParent;
use App\Ship\Parents\Presenters\PresenterParent;
use App\Ship\Parents\Repositories\RepositoryParent;

/**
 * @phpstan-template TFillable of array<string, mixed>
 * @phpstan-template TModel of ModelParent|AuthenticatableParent
 * @phpstan-template TRepository of RepositoryParent<TModel, TFillable>
 * @phpstan-template TRContract
 * @phpstan-template TDto of DtoParent
 * @phpstan-template TPresenter of PresenterParent<TModel, TDto>
 * @phpstan-template TPContract
 * @phpstan-extends GatewayCore<TFillable, TModel, TRepository, TRContract, TDto, TPresenter, TPContract>
 */
abstract class GatewayParent extends GatewayCore
{
}
