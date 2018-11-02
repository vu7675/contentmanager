<?php

namespace VincentNt\ContentManager;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ContentManagerEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'TCG\Voyager\Events\BreadAdded' => [
            'TCG\Voyager\Listeners\AddBreadMenuItem',
            'TCG\Voyager\Listeners\AddBreadPermission',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
