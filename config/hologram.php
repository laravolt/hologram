<?php
/*
 * Set specific configuration variables here
 */
return [
    // automatic loading of routes through main service provider
    'route'      => [
        'enabled'    => true,
        'prefix'     => 'hologram',
        'middleware' => ['web'],
    ],
    'view'       => [
        'layout'  => 'hologram::layout',
        'section' => 'body',
    ],
    'transformer' => \Laravolt\Hologram\Transformer::class,
];
