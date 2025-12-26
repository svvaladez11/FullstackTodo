<?php

namespace App\Ship\Core\Abstracts\Models;


use Illuminate\Database\Eloquent\Model;

abstract class ModelCore extends Model
{
    protected(set) string $resourceKey;

    public function __construct()
    {
        parent::__construct(func_get_args());

        $this->resourceKey = class_basename(static::class);
    }

}
