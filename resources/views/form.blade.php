<form wire:submit.prevent="submit" class="flex flex-col w-full">
    {!!
        $layout
            ->render()
            ->with([
                'fields' => $fields,
            ])
    !!}
</form>
