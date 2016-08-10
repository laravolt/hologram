<?php
namespace Laravolt\Hologram;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends \Spatie\Activitylog\Models\Activity
{

    protected $with = ['subject', 'causer'];

    public function scopeBy(Builder $query, Model $model)
    {
        return $query->where('causer_type', get_class($model))
                     ->where('causer_id', $model->getKey());
    }

    public function scopeOn(Builder $query, Model $model)
    {
        return $query->where('subject_type', get_class($model))
                     ->where('subject_id', $model->getKey());
    }

    public function scopeSearch(Builder $query, $keyword)
    {
        return $query->where('description', 'like', "%$keyword%");
    }
}
