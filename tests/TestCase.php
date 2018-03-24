<?php declare(strict_types=1);

use Kirkaracha\GuzzleGofer\GuzzleGoferFacade;
use Kirkaracha\GuzzleGofer\GuzzleGoferServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            GuzzleGoferServiceProvider::class
        ];
    }

    /**
     * Load package alias
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'GuzzleGofer' => GuzzleGoferFacade::class,
        ];
    }
}
