<?php

namespace VincentNt\ContentManager;

use Illuminate\Support\ServiceProvider;

class ContentManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        include __DIR__.'/routes/web.php';
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'contentmanager');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/contentmanager'),
        ]);
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');
//        $this->publishes([
//            __DIR__.'/assets' => public_path('vendor/contentmanager'),
//        ], 'public');

        $this->registerConsoleCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ContentManagerEventServiceProvider::class);
//        $this->app->make('VincentNt\ContentManager\Controllers\PageController');
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
}
