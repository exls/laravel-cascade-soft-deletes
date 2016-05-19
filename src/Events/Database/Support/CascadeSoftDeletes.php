<?php

namespace Exls\LaravelCascadeSoftDeletes\Events\Database\Support;


use Illuminate\Database\Eloquent\Model;

class CascadeSoftDeletes
{
    /**
     * Eloquent model instance
     * @var Model
     */
    public $model;
    /**
     * Relationships of model
     * @var array
     */
    public $relationships;

    /**
     * CascadeSoftDeletes constructor.
     * @param Model $model
     * @param array $relationships
     */
    public function __construct(Model $model, array $relationships) {
        $this->model = $model;
        $this->relationships = $relationships;
    }
}