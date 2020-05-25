<?php

namespace Response\Forms\Fields;

use Illuminate\Support\Facades\View;
use Response\Forms\Concerns\SupportsIcons;

class Password extends Text
{

    /** @var bool */
    protected $unmaskable = false;

    /**
     * Sets the unmaskable property, allowing the password to be shown or hidden by
     * toggling its visibility in the input.
     *
     * @param boolean $value
     * @return self
     */
    public function unmaskable($value = true)
    {
        $this->unmaskable = $value;

        return $this;
    }

    /**
     * Returns whether or not the field is unmaskable.
     *
     * @return boolean
     */
    public function isUnmaskable()
    {
        return $this->unmaskable;
    }

    /**
     * Renders the Field.
     *
     * @return string
     */
    public function render()
    {
        $this->addAttribute('class', $this->getResponsiveClasses());

        return View::make('forms::fields.password', [
            'field' => $this,
        ]);
    }

}
