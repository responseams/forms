@foreach($sections as $name => $section)
    <div class="md:grid md:grid-cols-3 md:gap-6"}>
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    @lang($section->title)
                </h3>

                @if($section->subtitle !== null || $section->subtitle !== '')
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        @lang($section->subtitle)
                    </p>
                @endif
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <x-card>
                <div class="flex flex-col w-full space-y-6">
                    <div class="grid md:grid-cols-{{ $layout->getColumns() }} gap-3 md:gap-6">
                        @foreach($fields[$name] as $field)
                            {!! $field->render() !!}
                        @endforeach
                    </div>

                    <div class="flex flex-row">
                        @if($loop->last && ! $layout->hasSubmitCard())
                                <x-buttons.primary size="md" submit :label="$layout->getSubmitText()" />
                        @endif
                    </div>
                </div>
            </x-card>
        </div>
    </div>

    @unless($loop->last && ! $layout->hasSubmitCard())
        <div class="hidden sm:block pt-10"></div>
    @endunless
@endforeach

@if($layout->hasSubmitCard())
    <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 sm:mt-0">
        <div class="md:col-span-1"></div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <x-card>
                <div>
                    <div class="sm:flex sm:items-start sm:justify-between">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                @lang($layout->getSubmitCardTitle())
                            </h3>

                            @unless(is_null($layout->getSubmitCardSubtitle()))
                                <div class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
                                    <p>
                                        {{ __($layout->getSubmitCardSubtitle(), ['button' => __('response.submit')]) }}
                                    </p>
                                </div>
                            @endunless
                        </div>
                        <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <x-buttons.primary size="md" submit :label="$layout->getSubmitText()" />
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endif
