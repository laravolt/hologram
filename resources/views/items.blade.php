@foreach($logs as $log)
    <div class="content">
        <div class="meta">
            {{ $log['time'] }}
        </div>
        <div class="description">
            {{ $log['description']}}
        </div>
    </div>
@endforeach
