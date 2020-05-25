<?php

namespace Response\Forms\Fields;

use Illuminate\Support\Facades\View;
use Response\Forms\Concerns\SupportsIcons;

class Text extends Field
{

    use SupportsIcons;

    /**
     * Sets a max length on the field and pushes a `max` validation rule to the validation
     * stack.
     *
     * @param int $maxlength
     * @return self
     */
    public function max($length = null)
    {
        if ($length === null) {
            $this->meta->forget('length');
            $this->validationRules->forget('max');

            return $this;
        }

        $this->meta->put('length', $length);
        $this->validationRules->put('max', $length);

        return $this;
    }

    /**
     * Sets the regular expression pattern to be validated on the input and in the validation
     * stack.
     *
     * @param string $pattern
     * @return self
     */
    public function pattern($pattern = null)
    {
        if ($pattern === null) {
            $this->meta->forget('pattern');
            $this->validationRules->forget('regex');

            return $this;
        }

        $this->meta->put('pattern', $pattern);
        $this->validationRules->put('regex', $pattern);

        return $this;
    }

    /**
     * Renders the Field.
     *
     * @return string
     */
    public function render()
    {
        $this->addAttribute('class', $this->getResponsiveClasses());

        return View::make('forms::fields.text', [
            'field' => $this,
        ]);
    }

}
