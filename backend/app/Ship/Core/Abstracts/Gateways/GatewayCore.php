<?php

namespace App\Ship\Core\Abstracts\Gateways;

use App\Containers\GvozdSection\GvozdGalleryImage\Models\GvozdGalleryImage;
use App\Ship\Core\Abstracts\Criteria\CriteriaCore;
use App\Ship\Core\Abstracts\Dto\DtoCore;
use App\Ship\Core\Abstracts\Models\AuthenticatableCore as Authenticatable;
use App\Ship\Core\Abstracts\Models\ModelCore;
use App\Ship\Core\Abstracts\Models\ModelCore as Model;
use App\Ship\Core\Abstracts\Presenters\PresenterCore;
use App\Ship\Core\Abstracts\Repositories\RepositoryCore;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Support\Collection;

/**
 * @phpstan-template TFillable of array<string,mixed>
 * @phpstan-template TModel of Model|Authenticatable
 * @phpstan-template TRepository of RepositoryCore<TModel, TFillable>
 * @phpstan-template TRepositoryContract
 * @phpstan-template TDto of DtoCore
 * @phpstan-template TPresenter of PresenterCore<TModel, TDto>
 * @phpstan-template TPresenterContract
 */
abstract class GatewayCore
{
    /** @phpstan-var TRepository $repository */
    private(set) RepositoryCore $repository;

    /** @phpstan-var TPresenter $presenter */
    private(set) PresenterCore $presenter;

    public function __construct()
    {
        /** @phpstan-var TRepository $repository */
        $repository = app($this->getRepositoryClass());
        $this->repository = $repository;
        /** @phpstan-var TPresenter $presenter */
        $presenter = app($this->getPresenterClass());
        $this->presenter = $presenter;
    }

    /**
     * @phpstan-return class-string<TRepositoryContract>
     */
    abstract protected function getRepositoryClass(): string;

    /**
     * @phpstan-return class-string<TPresenterContract>
     */
    abstract protected function getPresenterClass(): string;

    /**
     * @phpstan-return TRepository
     */
    protected function repositoryStartConditions(): RepositoryCore
    {
        return clone $this->repository;
    }

    /**
     * @phpstan-return TPresenter
     */
    protected function presenterStartConditions(): PresenterCore
    {
        return clone $this->presenter;
    }

    /**
     * @phpstan-param int|null $limit
     * @phpstan-param array<int, string> $select
     * @phpstan-param int $page
     * @phpstan-return Collection<int, TDto>
     */
    public function paginate(?int $limit = null, array $select = ['*'], int $page = 1): Collection
    {
        $collection = $this->repositoryStartConditions()->paginate($limit, $select, $page);
        return $this->presenterStartConditions()->presentCollection($collection);
    }


    /**
     * @phpstan-param TFillable[] $data
     * @phpstan-return bool
     */
    public function insert(array $data): bool
    {
        return $this->repositoryStartConditions()
            ->insert($data);
    }

    /**
     * @phpstan-param TFillable $data
     * @phpstan-return TDto
     */
    public function create(array $data): DtoCore
    {
        /** @phpstan-var TModel $model */
        $model = $this->repositoryStartConditions()
            ->create($data);
        return $this->presenterStartConditions()
            ->present($model);
    }


    /**
     * @phpstan-param string $field
     * @phpstan-param mixed $value
     * @phpstan-param string[] $select
     * @phpstan-return TDto|null
     */
    public function findByField(string $field, mixed $value, array $select = ['*']): ?DtoCore
    {
        $model = $this->repositoryStartConditions()->findByField($field, $value, $select);
        return $model ? $this->presenterStartConditions()->present($model) : null;
    }

    /**
     * @phpstan-param string $id
     * @phpstan-param TFillable $data
     * @phpstan-return bool
     */
    public function update(string $id, array $data): bool
    {
        return $this->repositoryStartConditions()
            ->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->repositoryStartConditions()
            ->delete($id);
    }

    /**
     * @param Expression|string $column
     * @return mixed
     */
    public function max(Expression|string $column): mixed
    {
        return $this->repositoryStartConditions()
            ->max($column);
    }

    /**
     * @param string[] $columns
     * @return Collection<int, TDto>
     */
    public function all(array $columns = ['*']): Collection
    {
        $collection = $this->repositoryStartConditions()
            ->all($columns);
        return $this->presenterStartConditions()
            ->presentCollection($collection);
    }

    /**
     * Push Criteria for filter the query
     *
     * @param CriteriaCore<TFillable, TModel, TRepository> $criteria
     * @return static
     */
    public function pushCriteria(CriteriaCore $criteria): static
    {
        $this->repository->pushCriteria($criteria);
        return $this;
    }
}
