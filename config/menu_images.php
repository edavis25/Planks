<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Storage Directories
    |--------------------------------------------------------------------------
    |
    */
    'storage' => [
        'food' => [
            'full_path'  => storage_path('app/public/dishes/food'),
            'local_path' => 'dishes/food'
        ],
        'beer' => [
            'full_path'  => storage_path('app/public/dishes/beer'),
            'local_path' => 'dishes/beer'
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Global Metadata Rules
    |--------------------------------------------------------------------------
    |
    */
    'metadata' => [
        'valid_extensions' => ['image/jpg', 'image/jpeg', 'image/png'],
        'max_width' => 1000,
        'max_filesize' => 5000000 /** 5MB in bytes */
    ],


    /*
    |--------------------------------------------------------------------------
    | Thumbnail Info
    |
    | @var prefix - string prepended to saved filename (file.jpg -> [thumbnail]file.jpg)
    | @var dimensions - in pixels
    |--------------------------------------------------------------------------
    |
    */
    'thumbnail'  => [
        'prefix' => '[thumbnail]',
        'dimensions' => [
            'height' => 500,
            'width'  => 500
        ]
    ],

];
