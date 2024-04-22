<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('server');
});

// Route::get('/{any}', function () {
//     $file = public_path('index');
//     $contents = file_get_contents($file);
//     return $contents;
// })->where('any', '.*');

