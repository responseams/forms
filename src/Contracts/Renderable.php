<?php

namespace Response\Forms\Contracts;

interface Renderable
{

    /**
     * Returns a View instance or string to render into the Blade application.
     *
     * @return View
     */
    public function render();

}
