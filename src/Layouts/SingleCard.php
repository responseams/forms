<?php

namespace Response\Forms\Layouts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Response\Forms\Concerns\HasColumns;
use Response\Forms\Concerns\HasSubmitButton;
use Response\Forms\Contracts\Renderable;

class SingleCard implements Renderable
{

    use HasColumns,
        HasSubmitButton;

    /** @var string */
    protected $title;

    /** @var string */
    protected $subtitle;

    /** Constructor */
    public function __construct($title, $subtitle = null)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Create a new instance of the SingleCard layout.
     *
     * @param string $title
     * @param string|null $subtitle
     * @return self
     */
    public static function make($title, $subtitle = null): self
    {
        return new static($title, $subtitle);
    }

    /**
     * Renders the Layout.
     *
     * @return View|string
     */
    public function render()
    {
        return View::make('forms::layouts.single-card', [
            'layout' => $this,
        ]);
    }

}
