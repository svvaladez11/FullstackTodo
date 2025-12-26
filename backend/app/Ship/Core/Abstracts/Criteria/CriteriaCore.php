<?php

namespace App\Ship\Core\Abstracts\Criteria;

use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use Illuminate\Database\Query\Builder;

/**
 * @phpstan-template TModel of ModelCore
 * @phpstan-template TRepository of RepositoryCore<TModel>
 */
abstract class CriteriaCore
{
    /**
     * Apply criteria in query repository
     *
     * @phpstan-param Builder|\Illuminate\Database\Eloquent\Builder<TModel>|TModel $model
     * @phpstan-param TRepository $repository
     *
     * @phpstan-return Builder|\Illuminate\Database\Eloquent\Builder<TModel>|TModel
     */
    abstract public function apply(ModelCore|Builder|\Illuminate\Database\Eloquent\Builder $model,
        RepositoryCore $repository,
    ): Builder|\Illuminate\Database\Eloquent\Builder|ModelCore;
}
