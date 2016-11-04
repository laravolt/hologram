@extends(config('laravolt.hologram.view.layout'))

@section(config('laravolt.hologram.view.section'))
    <h2 class="ui header">Hologram</h2>

    {!!
    $suitable->source($collection)
    ->title(trans('hologram::table.title'))
    ->columns([
        ['header' => trans('hologram::table.header.channel'), 'field' => 'channel'],
        ['header' => trans('hologram::table.header.by'), 'field' => 'by'],
        ['header' => trans('hologram::table.header.activity'), 'field' => 'description'],
        ['header' => trans('hologram::table.header.on'), 'field' => 'on'],
        ['header' => trans('hologram::table.header.time'), 'field' => 'time'],
    ])
    ->render()
    !!}
@endsection
