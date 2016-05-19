<?php
namespace Exls\LaravelCascadeSoftDeletes\Listeners\Database\Support;
use Exls\LaravelCascadeSoftDeletes\Events;
use Illuminate\Database\Eloquent\Relations\Relation;
use LogicException;

class CascadeSoftDeletes
{
    /**
     * @param Events\Database\Support\CascadeSoftDeletes $event
     */
    public function handle(Events\Database\Support\CascadeSoftDeletes $event) {
        $model = $event->model;
        foreach ($event->relationships as $relationship) {
            $relation = $model->{$relationship}();
            if ($relation instanceof Relation) {
                $relation->delete();
            } else {
                throw new LogicException(sprintf(
                    '%s [%s] must exist and return an object of type Illuminate\Database\Eloquent\Relations\Relation',
                    get_class($model),
                    $relationship
                ));
            }
        }
    }
}