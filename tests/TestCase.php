<?php declare(strict_types=1);

use Illuminate\Foundation\Application;
use Kirkaracha\GuzzleGofer\GuzzleGoferFacade;
use Kirkaracha\GuzzleGofer\GuzzleGoferServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            GuzzleGoferServiceProvider::class
        ];
    }

    /**
     * Load package alias
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            'GuzzleGofer' => GuzzleGoferFacade::class,
        ];
    }
}
