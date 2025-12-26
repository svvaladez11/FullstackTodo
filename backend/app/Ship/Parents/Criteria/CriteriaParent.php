<?php

namespace App\Ship\Parents\Criteria;

use App\Ship\Core\Abstracts\Criteria\CriteriaCore;
use App\Ship\Parents\Models\ModelParent;
use App\Ship\Parents\Repositories\RepositoryParent;

/**
 * @template TModel of ModelParent
 * @template TRepository of RepositoryParent<TModel>
 * @extends CriteriaCore<TModel, TRepository>
 */
abstract class CriteriaParent extends CriteriaCore
{
}
