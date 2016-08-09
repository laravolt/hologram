<?php

namespace Laravolt\Hologram;

class Factory
{
    public static function create($id, $class)
    {
        if (!$id && !is_string($class)) {
            return false;
        }

        return with(new $class())->find($id);
    }
}
