<?php
namespace Laravolt\Hologram;

use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    public function transform(Activity $model)
    {
        return [
            'id'          => (int)$model->id,
            'channel'     => $model->log_name,
            'by'          => $model->causer->name ?? null,
            'on'          => $model->subject->name ?? null,
            'properties'  => $model->properties,
            'description' => $model->description,
            'time'        => $model->created_at->diffForHumans(),
            'created_at'  => $model->created_at,
            'updated_at'  => $model->updated_at,
        ];
    }
}
