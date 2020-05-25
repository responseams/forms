<?php

use Illuminate\Support\Facades\App;

if (! function_exists('form')) {
    function form($formClass, $props = []) {
        return App::make('livewire')->mount($formClass, $props);
    }
}
