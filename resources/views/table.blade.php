{!!
$suitable->source($logs)
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
