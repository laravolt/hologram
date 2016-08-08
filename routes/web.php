<?php

$router->group(
    [
        'namespace'  => '\Laravolt\Hologram\Http\Controllers',
        'prefix'     => config('laravolt.hologram.route.prefix'),
        'as'         => 'hologram::',
        'middleware' => config('laravolt.hologram.route.middleware')
    ],
    function () use ($router) {
        $router->get('/', ['uses' => 'HologramController@index'])->name('index');
    }
);
