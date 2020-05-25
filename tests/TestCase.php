<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Response\Forms\Providers\FormsServiceProvider;

class TestCase extends BaseTestCase
{

    protected function getEnvironmentSetUp($app)
    {
        $app['config']
            ->set('view.paths', [ __DIR__ . '/views', resource_path('views')]);
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FormsServiceProvider::class,
        ];
    }

}
