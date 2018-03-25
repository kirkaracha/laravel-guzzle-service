<?php declare(strict_types=1);

namespace Kirkaracha\GuzzleGofer;

use Illuminate\Support\ServiceProvider;

class GuzzleGoferServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/guzzle-gofer.php' => config_path('guzzle-gofer.php'),
        ]);
    }

    /**
     * Register the application services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GuzzleGofer::class, function () {
            return new GuzzleGofer();
        });

        $this->app->alias(GuzzleGofer::class, 'guzzle-gofer');

        $this->mergeConfigFrom(
            __DIR__ . '/config/guzzle-gofer.php', 'guzzle-gofer'
        );
    }
}
