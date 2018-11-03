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
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'contentmanager');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/contentmanager'),
            __DIR__.'/database/migrations/' => database_path('migrations'),
            __DIR__.'/database/seeds/' => database_path('seeds'),
            __DIR__.'/controllers' => app_path('Http/Controllers/Admin'),
            __DIR__.'/images' => public_path('images'),
            __DIR__.'/models' => app_path(),
            __DIR__.'/events' => app_path('Events'),
            __DIR__.'/listeners' => app_path('Listeners'),
        ]);

        $this->registerConsoleCommands();
    }
    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
}
