<?php

namespace App\Ship\Core\Abstracts\Presenters;

use App\Ship\Core\Abstracts\Dto\DtoCore;
use App\Ship\Core\Abstracts\Models\ModelCore as Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use stdClass;

/**
 * @phpstan-template TModel of Model
 * @phpstan-template TDto of DtoCore
 */
abstract class PresenterCore
{
    /**
     * Gets a model and returns a stdClass
     * that has all the public properties of the passed model set.
     *
     * @param Model $model
     * @return stdClass Returns stdClass in which all public
     * properties of the passed model have been set
     */
    #[Pure]
    public function presentPublicProperties(Model $model): stdClass
    {
        $object = new stdClass();

        // gets array of properties and their values
        $properties = get_object_vars($model);

        // sets property values to a stdClass object
        foreach ($properties as $property => $value) {
            $object->{$property} = $value;
        }

        return $object;
    }
}
