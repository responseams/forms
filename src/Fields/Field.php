<?php

namespace Response\Forms\Fields;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Response\Forms\Concerns\AcceptsMeta;
use Response\Forms\Concerns\Responsive;

class Field
{

    use AcceptsMeta,
        Responsive;

    /** @var string */
    protected $id;

    /** @var string */
    protected $label;

    /** @var string */
    protected $name;

    /** @var string */
    protected $accessor;

    /** @var bool */
    protected $nullable = false;

    /** @var Collection */
    protected $validationRules;

    /** @var string */
    protected $helpText = null;

    /** @var array */
    protected $helpTextData = [];

    /** @var bool */
    protected $required = false;

    /** @var Collection */
    protected $attributes;

    /** @var mixed */
    protected $default = null;


    public function __construct($label, $name = null)
    {
        $this->id = Str::uuid();
        $this->label = $label;
        $this->name = $name ?? Str::snake(Str::lower($label));
        $this->accessor = 'data.' . $this->name;
        $this->validationRules = new Collection();
        $this->attributes = new Collection();
    }

    /**
     * Create an instance of the Field.
     *
     * @param string $label
     * @param string $name
     * @return self
     */
    public static function make($label, $name = null)
    {
        return new static($label, $name);
    }

    /**
     * Return the ID of the field.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Sets the default value.
     *
     * @param mixed $default
     * @return self
     */
    public function default($default): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Returns the default value.
     *
     * @return self
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Mark a Field as nullable, which allows Response to store a null value
     * instead of an empty string.
     *
     * This also adds the nullable validation rule.
     *
     * @return self
     */
    public function nullable($value = true)
    {
        $this->nullable = $value;
        $this->validationRules->{$value ? 'push' : 'pull'}('nullable');

        return $this;
    }

    /**
     * Adds help text that is displayed below the field. This will be translated so it can be
     * actual text or a translation string key. You may also provide HTML or a View instance
     * to render as help text.
     *
     * @param string $text
     * @return self
     */
    public function help($text, $data = [])
    {
        $this->helpText = $text;
        $this->helpTextData = $data;

        return $this;
    }

    /**
     * Annotates the field as required and adds the required validation rule.
     *
     * @return self
     */
    public function required($value = true)
    {
        $this->required = $value;
        $this->validationRules->{$value ? 'push' : 'pull'}('required');

        return $this;
    }

    /**
     * Merges the provided validation rules into the validationRules stack.
     *
     * @param mixed|array $rules
     * @return self
     */
    public function rules(...$rules)
    {
        $this->validationRules->push(...$rules);

        return $this;
    }

    /**
     * Returns the calculated help text from a View, a string, or a translation key.
     *
     * @return string|null
     */
    public function helpText()
    {
        if ($this->helpText instanceof View) {
            return $this->helpText->render();
        }

        return Lang::get($this->helpText, $this->helpTextData);
    }

    /**
     * Returns the calculated validation rules.
     *
     * @return array
     */
    public function validationRules(): array
    {
        return $this->validationRules
            ->map(function ($item, $key) {
                return $item;
            })
            ->toArray();
    }

    /**
     * Returns true if the field is required.
     *
     * @return boolean
     */
    public function isRequired(): bool
    {
        if ($this->validationRules->has('required')) {
            return true;
        }

        return $this->required;
    }

    /**
     * Returns true if the field is nullable.
     *
     * @return boolean
     */
    public function isNullable(): bool
    {
        if ($this->validationRules->has('nullable')) {
            return true;
        }

        return $this->nullable;
    }

    public function getAccessor(): string
    {
        return $this->accessor;
    }

    /**
     * Returns the name of the Field.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Returns the name of the Field.
     *
     * @return string
     */
    public function label(): string
    {
        return $this->label;
    }

    /**
     * Adds an attribute and appends to the attribute if it is already provided.
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function addAttribute($name, $value = true, $append = true)
    {
        if ($this->attributes->has($name) && !$append) {
            $this->attributes->set($name, [$value]);

            return $this;
        }

        if ($this->attributes->has($name)) {
            $old = $this->attributes->get($name);

            if (! is_array($value)) {
                $value = [$value];
            }

            $this->attributes->put(
                $name,
                array_merge(
                    $old,
                    $value,
                )
            );

            return $this;
        }

        if (! is_array($value)) {
            $value = [$value];
        }

        $this->attributes->put($name, $value);

        return $this;
    }

    /**
     * Gets a specific attribute and merges with the specific glue.
     *
     * @param string $name
     * @param string $glue
     * @return string
     */
    public function getAttribute($name, $glue = " "): string
    {
        $value = $this->attributes->get($name, []);

        if (! is_array($value)) {
            $value = [$value];
        }

        return implode($glue, $value);
    }

    /**
     * Gets all attributes or the specified attributes and converts them to a string.
     *
     * @param array $attributes
     * @param string $innerGlue
     * @return string
     */
    public function getAttributes($attributes = null, $innerGlue = " ")
    {
        $end = [];

        $this->attributes->each(function ($values, $name) use ($end, $innerGlue, $attributes) {
            if (! is_null($attributes) && ! in_array($name, $attributes)) {
                return;
            }

            $end[] = sprintf('%s="%s"', $name, implode($innerGlue, $values));
        });

        return implode(" ", $end);
    }
}
