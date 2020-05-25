<x-field
    :label="$field->label()"
    :for="$field->id()"
    :help-text="$field->helpText()"
    :error="$field->getAccessor()"
    :required="$field->isRequired()"
    :class="implode(' ', $field->getResponsiveClasses())"
>
    <x-field-input
        type="password"
        wire:model="{{ $field->getAccessor() }}"
        :right-icon="$field->getRightIcon()"
        :required="$field->isRequired()"
        :unmaskable="$field->isUnmaskable()"
    />
</x-field>
