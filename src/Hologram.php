<?php
namespace Laravolt\Hologram;

class Hologram
{
    protected $performedBy;

    protected $performedOn;

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

        return view('hologram::widget', compact('logs'));
    }

    public function renderAsTable()
    {
        $logs = $this->getData();
        $suitable = app('laravolt.suitable');

        return view('hologram::table', compact('logs', 'suitable'));
    }

    protected function getData()
    {
        $model = new Activity();

        if ($this->performedOn) {
            $model = $model->on($this->performedOn);
        }

        if ($this->performedBy) {
            $model = $model->by($this->performedBy);
        }

        return $model->paginate();
    }
}
