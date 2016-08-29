{!!
$suitable->source($logs)
->title(trans('hologram::table.title'))
->columns([
    ['header' => trans('hologram::table.header.channel'), 'field' => 'channel'],
    ['header' => trans('hologram::table.header.by'), 'field' => 'by'],
    ['header' => trans('hologram::table.header.activity'), 'field' => 'description'],
    ['header' => trans('hologram::table.header.on'), 'view' => 'hologram::changes'],
    ['header' => trans('hologram::table.header.time'), 'raw' => function($data){
        return sprintf('<span data-tooltip="%s" data-variation="small" data-inverted="">%s</span>', $data['created_at'], $data['time']);
    }],
])
->render()
!!}

<script>
    $(function(){
        $('.ui.modal').modal();
        $(document).on('click', '.button-show-modal', function(e){
            e.preventDefault();
            var target = $('#' + $(this).data('target'));
            console.log($(this).data('target'));
            target.modal('show');
        });
    });
</script>
