<?php
namespace Exls\LaravelCascadeSoftDeletes\Events\Database\Support;

use Illuminate\Contracts\Queue\ShouldQueue;

class QueuedCascadeSoftDeletes extends CascadeSoftDeletes implements ShouldQueue
{
}