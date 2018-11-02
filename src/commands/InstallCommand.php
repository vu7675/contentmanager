<?php

namespace VincentNt\ContentManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use VincentNt\ContentManager\ContentManagerServiceProvider;
use VincentNt\ContentManager\Database\Seeds\UsersTableSeeder;

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

        $this->info('Migrating the database tables into your application');
        $this->call('migrate:fresh');

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process($composer . ' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Adding routes to routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Voyager::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\nRoute::group(['prefix'=> 'admin'], function() {
    Route::get('/', '\VincentNt\ContentManager\Controllers\HomeController@index')->name('admin.index');
    Route::resources([
        'pages' => '\VincentNt\ContentManager\Controllers\PageController',
    ]);
    Route::get('/pageData', '\VincentNt\ContentManager\Controllers\DataController@pageData')->name('pageData');
    Route::get('/login', '\VincentNt\ContentManager\Controllers\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\VincentNt\ContentManager\Controllers\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', '\VincentNt\ContentManager\Controllers\LoginController@logout')->name('admin.logout');
});\n"
            );
        }

        $this->info('Seeding data into the database');
        $this->seed();

        $this->info('Successfully installed content manager! Enjoy');
    }


    public function seed()
    {
        with(new UsersTableSeeder())->run();
    }
}
