<?php

namespace VincentNt\ContentManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use VincentNt\ContentManager\ContentManagerServiceProvider;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'content-manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vendor publish and seeding for content manager package';

    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    public function handle(Filesystem $filesystem)
    {
        $this->info('Publishing the assets, database');
        $this->call('vendor:publish', ['--provider' => ContentManagerServiceProvider::class]);

        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, '\VincentNt\ContentManager')) {
            $this->info('Rewrite file for migration, multi-auth, seeding');
            $app_service_contents = $filesystem->get(__DIR__ . '/../rewrite_files/AppServiceProvider.php');
            $handler_contents = $filesystem->get(__DIR__ . '/../rewrite_files/Handler.php');
            $redirect_contents = $filesystem->get(__DIR__ . '/../rewrite_files/RedirectIfAuthenticated.php');
            $factory_contents = $filesystem->get(__DIR__ . '/../rewrite_files/UserFactory.php');
            $seed_contents = $filesystem->get(__DIR__ . '/../rewrite_files/DatabaseSeeder.php');
            $auth_contents = $filesystem->get(__DIR__ . '/../rewrite_files/auth.php');
            $url_contents = $filesystem->get(__DIR__ . '/../rewrite_files/web.php');
            $filesystem->put(
                app_path('Providers/AppServiceProvider.php'), $app_service_contents
            );
            $filesystem->put(
                app_path('Exceptions/Handler.php'), $handler_contents
            );
            $filesystem->put(
                app_path('Http/Middleware/RedirectIfAuthenticated.php'), $redirect_contents
            );
            $filesystem->put(
                database_path('factories/UserFactory.php'), $factory_contents
            );
            $filesystem->put(
                database_path('seeds/DatabaseSeeder.php'), $seed_contents
            );
            $filesystem->put(
                config_path('auth.php'), $auth_contents
            );
            $filesystem->put(
                base_path('routes/web.php'), $url_contents
            );
//            Artisan::call('make:auth');
        }
        $this->info('Successfully installed content manager! Enjoy');
    }
}
