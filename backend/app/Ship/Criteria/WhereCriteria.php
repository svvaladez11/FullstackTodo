<?php

namespace App\Ship\Criteria;

use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use App\Ship\Parents\Criteria\CriteriaParent;
use App\Ship\Parents\Models\ModelParent;
use App\Ship\Parents\Repositories\RepositoryParent;
use Illuminate\Database\Query\Builder;

/**
 * @phpstan-template TModel of ModelParent
 * @phpstan-template TRepository of RepositoryParent<TModel>
 * @phpstan-extends CriteriaParent<TModel, TRepository>
 */
class WhereCriteria extends CriteriaParent
{
    /**
     * @phpstan-param string $field
     * @phpstan-param string $operator
     * @phpstan-param mixed $value
     */
    public function __construct(
        private readonly string $field,
        private readonly string $operator,
        private readonly mixed $value,
    ) {
    }

    /**
     * @phpstan-param TModel|Builder|\Illuminate\Database\Eloquent\Builder<TModel> $model
     * @phpstan-param RepositoryCore<TModel> $repository
     * @phpstan-return Builder|\Illuminate\Database\Eloquent\Builder<TModel>|TModel
     */
    public function apply(
        ModelCore|Builder|\Illuminate\Database\Eloquent\Builder $model,
        RepositoryCore $repository
    ): Builder|\Illuminate\Database\Eloquent\Builder|ModelCore {
        /** @phpstan-var Builder|\Illuminate\Database\Eloquent\Builder<TModel>|TModel $model */
        $model = $model->where($this->field, $this->operator, $this->value);
        return $model;
    }
}
