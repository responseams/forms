<?php

namespace Response\Forms\Concerns;

trait SupportsIcons
{

    /** @var string */
    protected $rightIcon;

    /**
     * Sets the right-aligned icon for the input.
     *
     * @param string $icon
     * @return void
     */
    public function withRightIcon($icon)
    {
        $this->rightIcon = $icon;

        return $this;
    }

    /**
     * Returns the right-algined icon for the input.
     *
     * @return string|null
     */
    public function getRightIcon()
    {
        return $this->rightIcon;
    }

    /**
     * Returns true if the input has a right-aligned icon.
     *
     * @return boolean
     */
    public function hasRightIcon()
    {
        return !is_null($this->getRightIcon());
    }

}
