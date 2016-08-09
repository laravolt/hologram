<?php
namespace Laravolt\Hologram;

use Illuminate\Support\Collection;
use League\Fractal\Manager;

class Hologram
{
    protected $attributes;

    protected $performedBy;

    protected $performedOn;

    protected $latest = true;

    /**
     * Hologram constructor.
     */
    public function __construct()
    {
        $this->attributes = new Collection();
        $this->attributes['id'] = $this->generateRandomId();
    }


    public function by($actor)
    {
        $this->performedBy = $actor;

        return $this;
    }

    public function on($subject)
    {
        $this->performedOn = $subject;

        return $this;
    }

    public function renderAsWidget()
    {
        $logs = $this->getData();
        $attributes = $this->renderAttributes();
        $id = $this->attributes['id'];

        return view('hologram::widget', compact('logs', 'id', 'attributes'));
    }

    public function renderAsTable()
    {
        $logs = $this->getData();
        $suitable = app('laravolt.suitable');
        $attributes = $this->renderAttributes();
        $id = $this->attributes['id'];

        return view('hologram::table', compact('logs', 'suitable', 'id', 'attributes'));
    }

    public function id($id)
    {
        return $this->attr('id', $id);
    }

    public function attr($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function latest($latest = true)
    {
        $this->latest = $latest;

        return $this;
    }

    public function getData()
    {
        $model = new Activity();

        if ($this->performedOn) {
            $model = $model->on($this->performedOn);
            $this->attributes['data-on_type'] = get_class($this->performedOn);
            $this->attributes['data-on_id'] = $this->performedOn->getKey();
        }

        if ($this->performedBy) {
            $model = $model->by($this->performedBy);
            $this->attributes['data-by_type'] = get_class($this->performedBy);
            $this->attributes['data-by_id'] = $this->performedBy->getKey();
        }

        if ($this->latest) {
            $model = $model->latest();
        }

        $logs = $model->paginate();
        $data = new \League\Fractal\Resource\Collection($logs, app(config('laravolt.hologram.transformer')));
        $manager = new Manager();
        $result = $manager->createData($data)->toArray();

        return $result['data'];
    }

    protected function generateRandomId()
    {
        return 'hologram'.str_random();
    }

    protected function renderAttributes()
    {
        $result = '';

        foreach ($this->attributes as $attribute => $value) {
            $result .= " {$attribute}=\"{$value}\"";
        }

        return $result;
    }

}
