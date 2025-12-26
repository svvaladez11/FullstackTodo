<?php

namespace App\Ship\Criteria;

use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use App\Ship\Parents\Criteria\CriteriaParent;
use App\Ship\Parents\Models\ModelParent;
use App\Ship\Parents\Repositories\RepositoryParent;
use Closure;
use Illuminate\Database\Query\Builder;

/**
 * @phpstan-template TModel of ModelParent
 * @phpstan-template TRepository of RepositoryParent<TModel>
 * @phpstan-extends CriteriaParent<TModel, TRepository>
 */
class WhereHas extends CriteriaParent
{
    /**
     * @phpstan-param string $relation
     * @phpstan-param Closure|null $callback
     * @phpstan-param string $operator
     * @phpstan-param int $count
     * @phpstan-param mixed $value
     */
    public function __construct(
        private readonly string   $relation,
        private readonly ?Closure $callback = null,
        private readonly string   $operator = '>=',
        private readonly int      $count = 1
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
        $model = $model->whereHas(
            relation: $this->relation,
            callback: $this->callback,
            operator: $this->operator,
            count: $this->count,
        );
        return $model;
    }
}
