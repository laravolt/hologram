@extends(config('laravolt.hologram.view.layout'))

@section(config('laravolt.hologram.view.section'))
    <h2 class="ui header">Hologram</h2>

    {!!
    $suitable->source($collection)
    ->title(trans('hologram::table.title'))
    ->columns([
        ['header' => trans('hologram::table.header.channel'), 'field' => 'log_name'],
        ['header' => trans('hologram::table.header.by'), 'raw' => function($data){
            return $data->causer->name ?? null;
        }],
        ['header' => trans('hologram::table.header.activity'), 'field' => 'description'],
        ['header' => trans('hologram::table.header.on'), 'raw' => function($data){
            return $data->subject->title ?? null;
        }],
        ['header' => trans('hologram::table.header.time'), 'raw' => function($data){
            return $data->created_at->diffForHumans();
        }],
    ])
    ->render()
    !!}
@endsection
