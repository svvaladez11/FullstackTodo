<?php

namespace App\Ship\Criteria;

use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use App\Ship\Parents\Criteria\CriteriaParent;
use App\Ship\Parents\Models\ModelParent;
use App\Ship\Parents\Repositories\RepositoryParent;
use Illuminate\Database\Query\Builder;
use JetBrains\PhpStorm\ExpectedValues;

/**
 * @phpstan-template TModel of ModelParent
 * @phpstan-template TRepository of RepositoryParent<TModel>
 * @phpstan-extends CriteriaParent<TModel, TRepository>
 */
class OrderByCriteria extends CriteriaParent
{
    /**
     * @phpstan-param string $column
     * @phpstan-param string $direction
     */
    public function __construct(
        private readonly string $column,
        #[ExpectedValues(values: ['asc', 'desc'])]
        private readonly string $direction = 'asc',
    ) {
    }

    /**
     * @phpstan-param ModelParent|Builder|\Illuminate\Database\Eloquent\Builder<TModel> $model
     * @phpstan-param RepositoryCore<TModel> $repository
     * @phpstan-return Builder|\Illuminate\Database\Eloquent\Builder<TModel>|ModelParent
     */
    public function apply(
        ModelCore|Builder|\Illuminate\Database\Eloquent\Builder $model,
        RepositoryCore $repository
    ): Builder|\Illuminate\Database\Eloquent\Builder|ModelCore {
        /** @phpstan-var Builder|\Illuminate\Database\Eloquent\Builder<TModel>|ModelParent $model */
        $model = $model->orderBy(
            column: $this->column,
            direction: $this->direction,
        );
        return $model;
    }
}
