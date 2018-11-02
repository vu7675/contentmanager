<?php

namespace VincentNt\ContentManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use VincentNt\ContentManager\ContentManagerServiceProvider;
use VincentNt\ContentManager\Database\Seeds\UsersTableSeeder;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{

    protected $seedersPath = __DIR__ . '/../database/seeds/';

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
        $this->info($this->seedersPath);

        $this->call('vendor:publish', ['--provider' => ContentManagerServiceProvider::class]);

        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, '\VincentNt\ContentManager')) {
            $filesystem->makeDirectory(base_path('/public/images'));
            $this->info('Rewrite file for migrate and multi auth');
            $app_service_contents = $filesystem->get(__DIR__ . '/../rewrite_files/AppServiceProvider.php');
            $handler_contents = $filesystem->get(__DIR__ . '/../rewrite_files/Handler.php');
            $redirect_contents = $filesystem->get(__DIR__ . '/../rewrite_files/RedirectIfAuthenticated.php');
            $auth_contents = $filesystem->get(__DIR__ . '/../rewrite_files/auth.php');
            $url_contents = $filesystem->get(__DIR__ . '/../routes/web.php');
            $filesystem->put(
                base_path('app/Providers/AppServiceProvider.php'), $app_service_contents
            );
            $filesystem->put(
                base_path('app/Exceptions/Handler.php'), $handler_contents
            );
            $filesystem->put(
                base_path('app/Http/Middleware/RedirectIfAuthenticated.php'), $redirect_contents
            );
            $filesystem->put(
                base_path('config/auth.php'), $auth_contents
            );
            $this->info('Adding routes to routes/web.php');
            $filesystem->put(
                base_path('routes/web.php'), $url_contents
            );
            Artisan::call('make:auth');
        }
        $this->info('Dumping the autoloaded files and reloading all new files');
        $composer = $this->findComposer();
        $process = new Process($composer . ' dump-autoload');

        $this->info('Migrating the database tables into your application');
        $this->call('migrate:fresh');

        $process = new Process($composer . ' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Seeding data into the database');
        $this->seed();

        $this->info('Successfully installed content manager! Enjoy');
    }


    public function seed()
    {
        with(new UsersTableSeeder())->run();
    }
}
