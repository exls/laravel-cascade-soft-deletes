<?php
namespace Exls\LaravelCascadeSoftDeletes\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Exls\LaravelCascadeSoftDeletes\Events;
use Exls\LaravelCascadeSoftDeletes\Listeners;

class CascadeSoftDeletesProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Events\Database\Support\CascadeSoftDeletes::class => [
            Listeners\Database\Support\CascadeSoftDeletes::class,
        ],
        Events\Database\Support\QueuedCascadeSoftDeletes::class => [
            Listeners\Database\Support\CascadeSoftDeletes::class,
        ],
    ];
}
