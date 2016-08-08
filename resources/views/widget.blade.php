<div class="ui card fluid">
    <div class="content">
        <div class="header">@lang('hologram::widget.title')</div>
    </div>
    @foreach($logs as $log)
        <div class="content">
            <div class="meta">
                {{ $log->created_at->diffForHumans() }}
            </div>
            <div class="description">
                {{ $log->description }}
            </div>
        </div>
    @endforeach
    <div class="extra content">
        <button class="ui button basic fluid">@lang('hologram::widget.load_more')</button>
    </div>
</div>
