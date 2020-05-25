<?php

namespace Response\Forms\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\LivewireBladeDirectives;

class FormsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'forms');
        $this->publishes([__DIR__ . '/../../resources/views' => App::resourcePath('views/vendor/forms')], 'form-views');

        Blade::directive('form', [LivewireBladeDirectives::class, 'livewire']);
    }
}
