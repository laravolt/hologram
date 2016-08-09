<?php
namespace Laravolt\Hologram;

use Illuminate\Support\Collection;
use League\Fractal\Manager;

class Hologram
{
    protected $attributes;

    protected $performedBy;

    protected $performedOn;

    protected $keyword;

    /**
     * Hologram constructor.
     */
    public function __construct()
    {
        $this->attributes = new Collection();
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

    public function search($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function renderAsWidget()
    {
        $this->attributes['id'] = $this->generateRandomId();

        $attributes = $this->renderAttributes();
        $id = $this->attributes['id'];

        $logs = $this->getData();
        return view('hologram::widget', compact('logs', 'id', 'attributes'));
    }

    public function renderAsTable()
    {
        $this->attributes['id'] = $this->generateRandomId();

        $this->keyword = request('search');
        $suitable = app('laravolt.suitable');
        $attributes = $this->renderAttributes();
        $id = $this->attributes['id'];

        $logs = $this->getData();
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

        if ($this->keyword) {
            $model = $model->search($this->keyword);
        }

        $this->reset();

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

    protected function reset()
    {
        $this->performedBy = $this->performedOn = $this->keyword = null;
        $this->attributes = new Collection();
    }
}
