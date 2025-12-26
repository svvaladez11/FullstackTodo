<?php

namespace App\Ship\Parents\Dto;

use App\Ship\Core\Abstracts\Dto\DtoCore;

/**
 * @phpstan-template TArray of array<string, mixed>
 * @phpstan-extends DtoCore<TArray>
 */
abstract readonly class DtoParent extends DtoCore
{
}
