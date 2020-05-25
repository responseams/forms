<?php

namespace Response\Forms\Fields;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class Select extends Field
{

    /** @var array */
    protected $options;

    /** @var string */
    protected $display = 'label';

    /** @var string */
    protected $value = 'id';

    /** @var bool */
    protected $blank = false;

    /** @var string */
    protected $selected = null;

    /**
     * Set the options to be presented for the Field.
     *
     * @param mixed $options
     * @return self
     */
    public function options($options): self
    {
        if (is_callable($options)) {
            $options = call_user_func($options, $this);
        }

        if ($options instanceof Collection) {
            $this->options = $options;

            return $this;
        }

        $this->options = collect($options);

        return $this;
    }

    /**
     * Set the label to be used for the select options.
     *
     * @param string $with
     * @return self
     */
    public function displayAs($with): self
    {
        $this->display = $with;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getDisplayKey($item): string
    {
        $item = collect($item);

        return $item->get($this->display);
    }

    /**
     * Set the value to be used for the select options.
     *
     * @param string $with
     * @return self
     */
    public function valueAs($with): self
    {
        $this->value = $with;

        return $this;
    }

    /**
     * Returns the value key to be used when calculating the value for the
     * select options.
     *
     * @return string
     */
    public function getValueKey($item)
    {
        $item = collect($item);

        return $item->get($this->value);
    }

    /**
     * Returns all the options set for this field.
     *
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Returns the default value for a Select field, which works differently
     * than other Field instances.
     *
     * @return mixed
     */
    public function getDefault()
    {
        if (! is_null($this->default)) {
            return $this->default;
        }

        if ($this->isNullable()) {
            return null;
        }

        return $this->getValueKey(
            $this->options
                ->first(),
        );
    }

    /**
     * Renders the Field.
     *
     * @return string
     */
    public function render()
    {
        $this->addAttribute('class', $this->getResponsiveClasses());

        return View::make('forms::fields.select', [
            'field' => $this,
        ]);
    }

}
