<?php

namespace App\Ship\Core\Abstracts\Models;


use Illuminate\Database\Eloquent\Model;

abstract class ModelCore extends Model
{
    protected(set) string $resourceKey;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->resourceKey = class_basename(static::class);
    }

}
