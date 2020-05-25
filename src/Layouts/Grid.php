<?php

namespace Response\Forms\Layouts;

use Illuminate\Support\Facades\View;
use Response\Forms\Concerns\HasColumns;
use Response\Forms\Concerns\HasSubmitButton;
use Response\Forms\Contracts\Renderable;

class Grid implements Renderable
{

    use HasColumns,
        HasSubmitButton;

    /**
     * Create a new instance of the SplitSections
     *
     * @return self
     */
    public static function make(): self
    {
        return new static();
    }

    /**
     * Renders the Layout.
     *
     * @return View|string
     */
    public function render()
    {
        return View::make('forms::layouts.grid', [
            'layout' => $this,
        ]);
    }

}
