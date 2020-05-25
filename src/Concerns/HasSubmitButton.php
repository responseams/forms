<?php

namespace Response\Forms\Concerns;

trait HasSubmitButton
{

    /** @var string */
    protected $submitText = 'response.submit';

    /**
     * Sets the text to be displayed in the Submit button.
     *
     * @param string $text
     * @return self
     */
    public function submitText($text): self
    {
        $this->submitText = $text;

        return $this;
    }

    /**
     * Returns the text for the Submit button.
     *
     * @return string
     */
    public function getSubmitText()
    {
        return $this->submitText;
    }

}
