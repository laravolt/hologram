<?php
namespace Laravolt\Hologram\Repositories;

use Spatie\Activitylog\Models\Activity;

class EloquentLogRepository implements LogRepositoryInterface
{

    public function paginate()
    {
        return Activity::orderBy('created_at', 'DESC')->paginate();
    }
}
