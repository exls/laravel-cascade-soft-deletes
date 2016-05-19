Laravel CascadeSoftDeletes 
=============

## Introduction

In scenarios when you delete a parent record you may want to also delete any detail/child associated with it as a form of self-maintenance of your data.

Normally, you would use your database's foreign key constraints, adding an `ON DELETE CASCADE` rule to the foreign key constraint in your detail/child table.

If you need to be able to restore a parent record after it was deleted, check you may reach for Laravel's [soft deleting](https://laravel.com/docs/5.2/eloquent#soft-deleting) functionality.

But in this case you can use database feature to cascade delete details. This package support cascade soft deletes feature and support queues to make last one.

## Installation

Pull this package in through Composer.

```sh
    composer require exls/laravel-soft-deletes
```


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'  => array(

        //register listeners on events
        Exls\LaravelCascadeSoftDeletes\Providers\CascadeSoftDeletesServiceProvider::class,

    ),

```


## Usage

Change SoftDeletes trait in your models to CascadeSoftDeletes trait from this package
```php
<?php

namespace App\Models;

use App\Models\Master\Detail;
use Exls\LaravelCascadeSoftDeletes\Traits\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    //Instead of SoftDeletes
    use CascadeSoftDeletes;

    //Remove immideately details
    protected $cascadeDeletes = ['details'];
    
    // or use queues to soft delete details
    protected $queuedCascadeDeletes = ['details'];

	protected $dates = ['deleted_at'];

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}    
```

Now you can delete an `App\Models\Master` record, and any associated `App\Models\Master\Detail` records will be deleted. If the `App\Models\Master\Detail` record use the `CascadeSoftDeletes` trait as well, it's details/children will also be deleted and so on.

```php
    App\Models\Master::findOrFail($masterId)->delete()
```

## Tests

## Contact

Anton Pavlov

- Email: anton.pavlov.it@gmail.com