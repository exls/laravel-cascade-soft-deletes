<?php
/**
 */

namespace Exls\LaravelCascadeSoftDeletes\Traits;

use Exls\LaravelCascadeSoftDeletes\Events;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Event;

trait CascadeSoftDeletes
{
    use SoftDeletes;
    /**
     * Boot the trait.
     *
     * Listen for the deleting event of a soft deleting model, and run
     * the delete operation for any configured relationship methods.
     *
     * @throws \LogicException
     */
    protected static function bootCascadeSoftDeletes()
    {
        static::deleting(function ($model) {
            if ($relationships = $model->getCascadingDeletes()) {
                Event::fire(new Events\Database\Support\CascadeSoftDeletes($model, $relationships));
            }
            if ($relationships = $model->getQueuedCascadingDeletes()) {
                Event::fire(new Events\Database\Support\QueuedCascadeSoftDeletes($model, $relationships));
            }
        });
    }
    /**
     * Fetch the defined cascading soft deletes for this model.
     *
     * @return array
     */
    protected function getCascadingDeletes()
    {
        return isset($this->cascadeDeletes) ? (array) $this->cascadeDeletes : [];
    }

    /**
     * Fetch the defined queued cascading soft deletes for this model.
     *
     * @return array
     */
    protected function getQueuedCascadingDeletes()
    {
        return isset($this->queuedCascadeDeletes) ? (array) $this->queuedCascadeDeletes : [];
    }
}