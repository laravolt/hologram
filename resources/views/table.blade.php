{!!
$suitable->source($logs)
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
