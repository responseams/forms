<div class="grid md:grid-cols-{{ $layout->getColumns() }} gap-3 md:gap-6">
    @foreach($fields as $field)
        {!! $field->render() !!}
    @endforeach
</div>
