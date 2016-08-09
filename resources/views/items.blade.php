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
