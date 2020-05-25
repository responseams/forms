<?php

namespace Response\Forms;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Response\Forms\Fields\Field;
use Response\Forms\Layouts\Grid;
use Response\Support\Concerns\Livewire\DispatchesNotifications;

abstract class Form extends Component
{

    /** @var mixed */
    public $entity;

    /** @var string}int */
    public $key;

    /** @var array */
    public $data = [];

    /** @var array */
    public $rules = [];

    /**
     *
     *
     * @param mixed $entity
     * @return void
     */
    public function mount($entity = null)
    {
        $this->entity = $entity;
        $this->fillDefaults();
    }

    /**
     * Returns the Layout to be used by the Form. Returns null if not using
     * a Layout.
     *
     * @return Renderable;
     */
    public function layout()
    {
        return Grid::make();
    }

    /**
     * Returns a collection of the $data. This does not manipulate the $data
     * array.
     *
     * @return Collection
     */
    public function collected(): Collection
    {
        return collect($this->data);
    }

    /**
     * Returns an array of Fields to be added to the form.
     *
     * @return array|Renderable[]
     */
    abstract public function fields();

    /**
     * Returns the rules that should NOT be validated each time the form fields are
     * updated.
     *
     * @return array
     */
    public function ignoredRealtimeRules(): array
    {
        return ['confirmed'];
    }

    /**
     * Returns a Collection of Field instances keyed by their accessor.
     *
     * @return array
     */
    public function getFieldCollection(): Collection
    {
        $fields = new Collection();

        foreach ($this->iterateFields($this->fields()) as $field) {
            $fields->put($field->getAccessor(), $field);
        }

        return $fields;
    }

    public function mergeFieldRules($ignored = null)
    {
        $ignored = $ignored ? array_merge($ignored, $this->ignoredRealtimeRules()) : $this->ignoredRealtimeRules();
        $rules = [];

        foreach ($this->iterateFields($this->fields()) as $field) {
            $rules[$field->getAccessor()] = array_diff($field->validationRules(), $ignored);
        }

        return $rules;
    }

    /**
     * Recursively iterates and returns all Field instances in a flat array.
     *
     * @param array $fields
     * @return array
     */
    private function iterateFields($fields): array
    {
        $iterated = [];

        foreach($fields as $field) {
            if ($field instanceof Field) {
                $iterated[] = $field;

                continue;
            }

            if (is_array($field)) {
                $iterated = array_merge($iterated, $this->iterateFields($field));

                continue;
            }
        }

        return $iterated;
    }

    /**
     * Fills the $data array with all of the default values.
     *
     * @return void
     */
    private function fillDefaults()
    {
        foreach ($this->iterateFields($this->fields()) as $field) {
            $this->data[$field->name()] = $field->getDefault();
        }
    }

    /**
     * Called when each field is updated.
     *
     * @param string $field
     * @param string $value
     * @return void
     */
    public function updated($field, $value)
    {
        $this->validateOnly($field, $this->mergeFieldRules());
    }

    /**
     * Called by the form on submit.
     *
     * @return mixed
     */
    public function submit()
    {
        $values = $this->validate($this->mergeFieldRules());

        if (method_exists($this, 'onSubmit')) {
            $response = $this->onSubmit($values['data']);

            if (method_exists($this, 'respondSuccess')) {
                return $this->respondSuccess($response);
            }

            return $response;
        }
    }

    /**
     * Renders the Form as a Livewire component.
     *
     * @return View|string
     */
    public function render()
    {
        return View::make('forms::form', [
            'layout' => $this->layout(),
            'fields' => $this->fields(),
        ]);
    }
}
