<?php

namespace Response\Forms\Layouts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Response\Forms\Concerns\HasColumns;
use Response\Forms\Concerns\HasSubmitButton;
use Response\Forms\Contracts\Renderable;

class SplitSections implements Renderable
{

    use HasColumns,
        HasSubmitButton;

    /** @var Collection */
    protected $sections;

    /** @var bool */
    protected $submitCard = false;

    /** @var string */
    protected $submitCardTitle;

    /** @var string */
    protected $submitCardSubtitle;

    /** Constructor */
    public function __construct()
    {
        $this->sections = new Collection();
    }

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
     * Add a Section to the layout.
     *
     * @param string $title
     * @param string|NULL $subtitle
     * @return self
     */
    public function section($name, $title, $subtitle = null): self
    {
        $this->sections->put(
            $name,
            $this->newSectionObject($title, $subtitle),
        );

        return $this;
    }

    /**
     * Place the submit button on a separate card instead of on the last section.
     *
     * @param string $title
     * @param string|null $subtitle
     * @return self
     */
    public function withSubmitCard($title, $subtitle = null): self
    {
        $this->submitCard = true;
        $this->submitCardTitle = $title;
        $this->submitCardSubtitle = $subtitle;

        return $this;
    }

    /**
     * Returns true if the Layout has a Submit Card.
     *
     * @return boolean
     */
    public function hasSubmitCard(): bool
    {
        return $this->submitCard;
    }

    /**
     * Returns the title for the Submit card.
     *
     * @return string
     */
    public function getSubmitCardTitle()
    {
        return $this->submitCardTitle;
    }

    /**
     * Returns the subtitle for the submit card.
     *
     * @return string|null
     */
    public function getSubmitCardSubtitle()
    {
        return $this->submitCardSubtitle;
    }

    /**
     * Builds a new section given the $title, $subtitle, and $fields.
     *
     * @return object
     */
    private function newSectionObject($title, $subtitle): object
    {
        return (object) [
            'title' => $title,
            'subtitle' => $subtitle,
        ];
    }

    /**
     * Renders the Layout.
     *
     * @return View|string
     */
    public function render()
    {
        return View::make('forms::layouts.split-sections', [
            'sections' => $this->sections->toArray(),
            'layout' => $this,
        ]);
    }

}
