<?php
namespace Laravolt\Hologram;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'laravolt.hologram';
    }
}
