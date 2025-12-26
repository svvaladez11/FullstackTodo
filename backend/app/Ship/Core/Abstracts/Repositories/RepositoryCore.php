<?php

namespace App\Ship\Core\Abstracts\Repositories;

use App\Ship\Core\Abstracts\Criteria\CriteriaCore;
use App\Ship\Core\Abstracts\Models\ModelCore as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as IlluminateCollection;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use stdClass;

/**
 * @psalm-template TModel of Model
 */
abstract class RepositoryCore
{
    /** @psalm-var TModel $model Installed model. */
    private(set) Model $model;

    /** @psalm-var IlluminateCollection<int, CriteriaCore<TModel, static>> Collection of criteria. */
    private(set) IlluminateCollection $criteria;


    /**
     * @psalm-var int $paginationLimit Limit of elements.
     */
    private int $paginationLimit = 10;

    public function __construct()
    {
        $this->criteria = new IlluminateCollection();
        /** @psalm-var TModel $model */
        $model = app($this->getModelClass());
        $this->model = $model;
    }

    /**
     * @psalm-return class-string<TModel>
     */
    abstract protected function getModelClass(): string;

    /**
     * Method of querying a table through an installed model
     *
     * @psalm-return TModel Returns a clone of the given model.
     */
    protected function startConditions(): Model
    {
        return clone $this->model;
    }

    /**
     * Returns a paginated list of resources.
     *
     * @psalm-param int|null $limit Limit of elements.
     * @psalm-param array<int, string> $select Selected columns.
     * @psalm-param int $page Number of pagination page.
     * @psalm-return Collection<int, TModel> Returns a collection of models
     * in the format key => value, where key is an int and value is
     * the installed model object.
     */
    public function paginate(?int $limit = null, array $select = ['*'], int $page = 1): Collection
    {
        if ($limit) {
            $this->paginationLimit = $limit;
        }

        /** @var TModel|Builder $model */
        $model = $this->applyCriteria();

        /** @psalm-var LengthAwarePaginator<int> $paginator */
        $paginator = $model
            ->paginate(
                $this->paginationLimit,
                $select,
                'page',
                $page
            );
        /** @psalm-var Collection<int, TModel> $collection */
        $collection = $paginator->getCollection();
        $collection->macro('links', function () use ($paginator) {
            return $paginator->links();
        });
        $collection->macro('linksToJson', function () use ($paginator) {
            $linksToJson = new stdClass();
            $linksToJson->current_page = $paginator->currentPage();
            $linksToJson->per_page = $paginator->perPage();
            $linksToJson->total = $paginator->total();
            $linksToJson->last_page = $paginator->lastPage();
            $linksToJson->links = new stdClass();
            $linksToJson->links->prev = $paginator->previousPageUrl();
            $linksToJson->links->next = $paginator->nextPageUrl();
            return $linksToJson;
        });

        return $collection;
    }

    /**
     * Returns the first element matching the request.
     *
     * @psalm-param string $field Field to search for.
     * @psalm-param mixed $value Value to search for.
     * @psalm-param string[] $select Selected columns.
     * @psalm-return TModel|null Returns a model object.
     */
    public function findByField(string $field, mixed $value, array $select = ['*']): Model|null
    {
        /** @var TModel|Builder $model */
        $model = $this->applyCriteria();

        /** @var TModel|null $result */
        $result = $model
            ->select($select)
            ->where($field, '=', $value)
            ->first();
        return $result;
    }

    /**
     * Retrieve the maximum value of a given column.
     *
     * @param Expression|string $column
     * @return mixed
     */
    public function max(Expression|string $column): mixed
    {
        /** @var TModel|Builder $model */
        $model = $this->applyCriteria();

        return $model->max($column);
    }

    /**
     * @psalm-param string[] $columns
     * @psalm-return Collection<int, TModel>
     */
    public function all(array $columns = ['*']): Collection
    {
        /** @var TModel|Builder $model */
        $model = $this->applyCriteria();

        /** @psalm-var Collection<int, TModel> $model */
        $model = $model->get($columns);
        return $model;
    }

    /**
     * Push Criterion for filter the query
     *
     * @psalm-param CriteriaCore<TModel, static> $criterion
     * @psalm-return static
     */
    public function pushCriterion(CriteriaCore $criterion): static
    {
        $this->criteria->push($criterion);

        return $this;
    }

    /**
     * Clear criteria collection
     *
     * @return static
     */
    public function clearCriteria(): static
    {
        $this->criteria = new IlluminateCollection();

        return $this;
    }

    /**
     * @return Builder|\Illuminate\Database\Eloquent\Builder<TModel>|Model
     */
    protected function applyCriteria(): Builder|\Illuminate\Database\Eloquent\Builder|Model
    {
        // gets a clean query to the model
        $model = $this->startConditions();

        // gets an array of criteria
        /** @psalm-var array<CriteriaCore<TModel, static>> $criteria */
        $criteria = $this->criteria->toArray();

        foreach ($criteria as $criterion) {
            /** @psalm-var TModel|Builder|\Illuminate\Database\Eloquent\Builder<TModel> $model */
            $model = $criterion->apply($model, $this);

        }

        return $model;
    }
}
