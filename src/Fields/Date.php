<?php

namespace Response\Forms\Fields;

use Illuminate\Support\Facades\View;

class Date extends Text
{

    /**
     * Renders the Field.
     *
     * @return string
     */
    public function render()
    {
        $this->addAttribute('class', $this->getResponsiveClasses());

        return View::make('forms::fields.text', [
            'type' => 'date',
            'field' => $this,
        ]);
    }

}
